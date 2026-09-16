<?php

namespace App\Traits;

use App\Models\{Post, Term, Translation};
use Cocur\Slugify\Slugify;
use Illuminate\Support\{Arr, Carbon, Str};
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait PostTrait
{
    use ImageTrait, LanguageTrait;

    /**
     * storeGalleryFileAndGetJson
     *
     * @param  mixed $image
     * @return void
     */
    public function storeGalleryFileAndGetJson($image)
    {
        $file         = $image->getClientOriginalName();
        $file0        = explode('.', $file);
        $_filename    = head($file0);
        $_extension   = last($file0);
        $filename     = $_filename . '-' . Str::random(10) . '.' . $_extension;
        $mimetype     = request()->file->getClientMimeType();
        $imagedetails = getimagesize(request('file'));
        $width        = $imagedetails[0];
        $height       = $imagedetails[1];

        $image->storeAs('images', $filename, $this->diskName());

        return [
            'mimetype' => $mimetype,
            'url'      => $filename,
            'meta'     => [
                'file'           => $filename,
                'type'           => $image->extension(),
                'size'           => $image->getSize(),
                'dimension'      => $width . 'x' . $height,
                'attr_image_alt' => $filename,
            ]
        ];
    }

    /**
     * storePostThumbAndGetFileName
     *
     * @param  mixed $image
     * @return void
     */
    public function storePostThumbAndGetFileName($image)
    {
        if (!File::exists($this->pathLocal('images/80'))) {
            File::makeDirectory($this->pathLocal('images/80'));
        }

        if (!File::exists($this->pathLocal('images/300'))) {
            File::makeDirectory($this->pathLocal('images/300'));
        }

        if (!File::exists($this->pathLocal('images/356'))) {
            File::makeDirectory($this->pathLocal('images/356'));
        }

        $getFileName      = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $getFileExtension = pathinfo($image->getClientOriginalExtension(), PATHINFO_FILENAME);
        $fileName         = $getFileName . '-' . Str::random(10) . '.' . $getFileExtension;

        // resize the image to 736x414
        Image::make($image)->resize(736, null, function ($constraint) {
            $constraint->aspectRatio();
        })->resizeCanvas(736, 414, 'center', false, '#181818')
        ->save($this->pathImage() .'/'. $fileName );

        // resize the image to 356x200
        Image::make($image)->resize(356, null, function ($constraint) {
            $constraint->aspectRatio();
        })->resizeCanvas(356, 200, 'center', false, '#181818')
        ->save($this->pathImage() . '/356/' . $fileName );

        // resize the image to 300x169
        Image::make($image)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })->resizeCanvas(300, 169, 'center', false, '#181818')
        ->save($this->pathImage() . '/300/' . $fileName );

        // resize the image to 80x80
        Image::make($image)->resize(80, null, function ($constraint) {
            $constraint->aspectRatio();
        })->resizeCanvas(80, 45, 'center', false, '#181818')
        ->save($this->pathImage() . '/80/' . $fileName );

        return $fileName;
    }

    /**
     * Generate Another Size Post Thumbnail if not exists
     *
     * @param mixed $post
     * @param mixed $size
     * @param mixed $ratio
     * @return void
     */
    public function generateAnotherSizePostThumbnailIfNotExists($post, $size)
    {
        $path = $size ?  '/' . $size . '/' : '/';
        $ratio = 16/9;

        if (!File::exists($this->pathLocal('images/' . $size))) {
            File::makeDirectory((new class { use StorageDiskTrait; })->pathLocal('images') . $path);
        }

        try {
            return Image::make($this->diskStorage()->get('images/' . $post->post_image))
                ->resize($size, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas($size, round($size/$ratio), 'center', false, '#181818')
                ->save($this->pathLocal('images') . $path . $post->post_image);
        } catch (\Throwable $exception) {
            return null;
        }
    }

    /**
     * addTranslation
     *
     * @param  mixed $post
     * @param  mixed $request
     * @return void
     */
    public function addTranslation($post, $request)
    {
        $lang = $this->getLanguageCodeById($request->integer('post_language'));

        if ($request->has('trans_id')) {
            $translation        = Translation::find($request->trans_id);
            $valueArr           = json_decode($translation->value, true);
            $valueAdded         = Arr::add($valueArr, $lang, $post->id);
            $translation->value = json_encode($valueAdded);
            $translation->save();

            $post->translations()->sync([$request->trans_id]);
        } else {
            $translation = Translation::create([
                'value' => json_encode([
                    $lang => $post->id,
                ])
            ]);

            $post->translations()->attach([
                'translation_id' => $translation->id
            ]);
        }
    }

    /**
     * @param $request
     * @param $post
     * @return void
     */
    public function attachCategories($request, $post)
    {
        if ($request->filled('categories')) {
            foreach($request->categories as $key => $value) {
                $post->terms()->attach([
                    'term_id' => (int) $value
                ]);
            }
        }
    }

    /**
     * @param $request
     * @param $post
     * @return void
     */
    public function attachTags($request, $post)
    {
        if (!is_null(request('tags'))) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag) {
                $tags = Term::tag()
                    ->where('name', $tag)
                    ->where('language_id', $request->language)->first();

                if ($tags) {
                    $tag_taxonomy_id = $tags->id;
                    $post->terms()->attach([
                        'term_taxonomy_id' => $tag_taxonomy_id
                    ]);
                } else {
                    $slugify = new Slugify();
                    $tag = Term::create([
                        'name' => $tag,
                        'slug' => $slugify->slugify($tag),
                        'taxonomy' => 'tag',
                        'language_id' => $request->language_id
                    ]);
                    $post->terms()->attach([
                        'term_id' => $tag->id
                    ]);
                }
            }
        }
    }

    /**
     * syincTerms
     *
     * @param  mixed $request
     * @return array
     */
    public function syincTerms($request): array
    {
        $terms = [];

        if ($request->filled('categories')) {
            foreach($request->categories as $key => $value){
                $terms[] = (int) $value;
            }
        }

        if (!is_null(request('tags'))) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag) {
                $term = Term::tag()->firstWhere('name', $tag);
                if ($term) {
                    $terms[] = $term->id;
                } else {
                    $slugify = new Slugify();
                    $tag = Term::create([
                        'name' => $tag,
                        'slug' => $slugify->slugify($tag),
                        'taxonomy' => 'tag',
                        'language_id' => $request->language_id
                    ]);
                    $terms[] = $tag->id;
                }
            }
        }

        return $terms;
    }

    /**
     * getPostTitleById
     *
     * @param  mixed $id
     * @return void
     */
    public function getPostTitleById($id)
    {
        return Post::find($id)->post_title;
    }

    /**
     * deletePost
     *
     * @param  mixed $item
     * @return void
     */
    public function deletePost($item)
    {
        $transId     = $item->translations->first()->id;
        $translation = Translation::find($transId);
        $valueArr    = json_decode($translation->value, true);

        if (count($valueArr) == 1) {
            if ($item->post_image) {
                $this->deleteImage('images', $item->post_image);
                $this->deleteImage('images/80', $item->post_image);
                $this->deleteImage('images/300', $item->post_image);
                $this->deleteImage('images/356', $item->post_image);
            }

            preg_match_all('/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s', $item->post_content, $url_images);

            foreach ($url_images[3] as $url_image) {
                $image = last(explode('/', $url_image));
                $this->deleteImage('images', $image);
            }
        }
        $key = array_search($item->id, $valueArr, true);

        if ($key !== false) {
            unset($valueArr[$key]);
        }

        $translation->value = json_encode($valueArr);
        $translation->save();
    }

    /**
     * Create date time from request
     *
     * @param mixed $request
     * @return void
     */
    public function createDateTimeFromRequest($request)
    {
        $date = $request->year .'-'. $request->month .'-'. $request->days;
        $time = $request->hour .':'. $request->minute .' '. $request->timeFormat;
        $dateTime = $date .' '.$time;

        return Carbon::createFromFormat('Y-m-d H:i A', $dateTime)->toDateTimeString();
    }
}
