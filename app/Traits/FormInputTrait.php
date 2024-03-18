<?php

namespace App\Traits;

use App\Helpers\TermHelper;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait FormInputTrait
{    
    /**
     * languageSelect
     *
     * @return void
     */
    public function languageSelect() {
        $html = '<ul class="list-flags list-inline float-right ml-2 mb-0">';

        /** @var TermHelper */
        $listFlags = LocalizationTrait::listFlags();

        foreach ($listFlags as $language) {
            $active = ($language->id == Auth::user()->language) ? 'active' : '';
            $html .= '<li class="list-inline-item mr-0 ' .$active . '" data-lang="' . $language->language . '"><i class="flag-icon flag-icon-' . Str::lower($language->country_code) .'"></i></li>';
        }

        $html .= '</ul>';
    
        return $html;
    }
    
    /**
     * postTypeInput
     *
     * @param  mixed $data
     * @return void
     */
    public function postTypeInput($type, $data) {
       if ($type == 'post') {
            $postType = [
                'post' => __('form.post'),
                'post_by_category' => __('form.post_by_category')
            ];
       } elseif ($data['post_type'] == 'video') {
           $postType = [
               'video' => __('form.video'),
               'video_by_category' => __('form.video_by_category')
           ];
       } else {
           $postType = [
               'audio' => __('form.audio'),
               'audio_by_category' => __('form.audio_by_category')
           ];
       }

        $html = '<div id="_wm_post_type_el" class="form-group">
        <label for="_wm_post_type">' . __('form.post_type') . '</label>
            <select id="_wm_post_type" class="form-control" name="post_type">';
                foreach($postType as $index => $post) {
                    if ($index == $data['post_type']) {
                        $html .= '<option value="'.$index.'" selected>'.$post.'</option>';
                    } else {
                        $html .= '<option value="'.$index.'">'.$post.'</option>';
                    }
                }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * categoryInput
     *
     * @param  mixed $data
     * @return void
     */
    public function categoryInput($data) {
        if ($data['post_type'] == 'post') {
            $postType = [
                'post' => __('form.post'),
                'post_by_category' => __('form.post_by_category')
            ];
            $noneCategory = $data['post_type'] == 'post' ? 'd-none' : '';
        } elseif ($data['post_type'] == 'video') {
            $postType = [
                'video' => __('form.video'),
                'video_by_category' => __('form.video_by_category')
            ];
            $noneCategory = $data['post_type'] == 'video' ? 'd-none' : '';
        } else {
            $postType = [
                'audio' => __('form.audio'),
                'audio_by_category' => __('form.audio_by_category')
            ];
            $noneCategory = $data['post_type'] == 'audio' ? 'd-none' : '';
        }

        /** @var TermHelper */
        $categories = TermHelper::getCategory();

        $html = '<div id="_wm_category_el" class="form-group ' . $noneCategory . '">
            <label for="_wm_category">' . __('form.category') . '</label>
            <select id="_wm_category"
                    name="category"
                    class="select2"
                    data-placeholder="' . __('form.select_category') . '"
                    style="width: 100%">';
                        foreach ($categories as $category) {
                            if ($category->slug == $data['category']) {
                                $html .= '<option value="' . $category->id . '" selected="selected"> ' . $category->name . ' </option>';
                            } else {
                                $html .= '<option value="' . $category->id . '"> ' . $category->name . ' </option>';
                            }
                        }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * layoutTypeInput
     *
     * @param  mixed $widget
     * @param  mixed $data
     * @return void
     */
    public function layoutTypeInput($widget, $data) {
        if ($widget == 'posts' OR $widget == 'post' OR $widget == 'video' OR $widget == 'audio') {
            $layoutType = [
                'one-column' => 'One Column',
                'two-column' => 'Two Column'
            ];
        } else if ($widget == 'post_sidebar' OR $widget == 'video_sidebar' OR $widget == 'audio_sidebar') {
            $layoutType = [
                'list-post-with-link' => 'List Post with Link',
                'first-large-thumb' => 'First Large Thumbnail',
                'regular-list-posts' => 'Regular List Posts'
            ];
        } else if ($widget == 'bottom_post') {
            $layoutType = [
                'horizontal-slider' => 'Horizontal Slider',
                'horizontal' => 'Horizontal'
            ];
        } else if ($widget == 'mini_post') {
            $layoutType = [
                'vertical-slider' => 'Vertical Slider',
                'vertical' => 'Vertical'
            ];
        } else if ($widget == 'list_label') {
            $layoutType = [
                'ordered-lists' => 'Ordered Lists',
                'unordered-lists' => 'Unordered Lists'
            ];
        }

        $html = '<div id="_wm_layout_type_el" class="form-group">
            <label for="_wm_layout_type">'.__('form.layout_type').'</label>
            <select id="_wm_layout_type" class="form-control" name="layout_type">';
                foreach($layoutType as $index => $layout) {
                    if ($index == $data['layout_type']) {
                        $html .= '<option value="'.$index.'" selected>'.$layout.'</option>';
                    } else {
                        $html .= '<option value="'.$index.'">'.$layout.'</option>';
                    }
                }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * titleInput
     *
     * @param  mixed $data
     * @return void
     */
    public function titleInput($data) {
        $language = Language::find(Auth::user()->language);

        $html = '<div id="_wm_title_el" class="form-group">
            <label for="_wm_title">' . __('form.title') . '</label>';
            if ($data['title']) {
                foreach($data['title'] as $lang => $title) {
                    $hidden = ($language->language != $lang) ? 'hidden' : '';
                    $html .= '<input type="text" class="form-control _wm_title input-desc-' . $lang . '" name="title[' . $lang . ']" value="' . $title . '" ' . $hidden . '>';
                }
            } else {
                $html .= '<input type="text" class="form-control _wm_title input-desc-' . $language->language . '" name="title[' . $language->language . ']">';
            }
            
        $html .= '</div>';

        return $html;
    }
    
    /**
     * descriptionInput
     *
     * @param  mixed $data
     * @return void
     */
    public function descriptionInput($data) {
        $language = Language::find(Auth::user()->language);
   
        $html = '<div id="_wm_description_el" class="form-group">
            <label for="_wm_description">'.__('form.description').' </label>';
            if ($data['description']) {
                foreach($data['description'] as $lang => $description) {
                    $hidden = ($language->language != $lang) ? 'hidden' : '';
                    $html .= '<textarea name="description[' . $lang . ']" class="form-control _wm_description input-desc-' . $lang . '" rows="3" ' . $hidden . '>' . $description . '</textarea>';
                }
            } else {
                $html .= '<textarea name="description[' . $language->language . ']" class="form-control _wm_description input-desc-' . $language->language . '" rows="3"></textarea>';
            }
        $html .= '</div>';

        return $html;
    }
    
    /**
     * oderInput
     *
     * @param  mixed $data
     * @return void
     */
    public function oderInput($data) {
        $orders = [
            'latest'  => 'Latest',
            'oldest'  => 'Oldest',
            'popular' => 'Popular',
            'random'  => 'Random'
        ];

        $html = '<div id="_wm_order_el" class="form-group">
            <label for="_wm_order">'.__('form.order').'</label>
            <select id="_wm_order" class="form-control" name="order">';
        foreach($orders as $index => $order) {
            if ($index == $data['order']) {
                $html .= '<option value="'.$index.'" selected>'.$order.'</option>';
            } else {
                $html .= '<option value="'.$index.'">'.$order.'</option>';
            }
        }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * popularBasedInput
     *
     * @param  mixed $data
     * @return void
     */
    public function popularBasedInput($data) {
        $populars = [
            'all'   => 'All',
            'day'   => 'Day',
            'week'  => 'Week',
            'month' => 'Month',
            'year'  => 'Year'
        ];

        $none = $data['order'] == 'popular' ?: 'd-none';

        $html = '<div id="_wm_popular_based_el" class="form-group '.$none.'">
            <label for="_wm_popular_based">'.__('form.popular').'</label>
            <select id="_wm_popular_based" class="form-control" name="popular_based">';
        foreach($populars as $index => $popular) {
            if ($index == $data['popular_based']) {
                $html .= '<option value="'.$index.'" selected>'.$popular.'</option>';
            } else {
                $html .= '<option value="'.$index.'">'.$popular.'</option>';
            }
        }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * numberofPostsInput
     *
     * @param  mixed $data
     * @return void
     */
    public function numberofPostsInput($data) {
        return '<div id="_wm_number_of_posts_el" class="form-group">
            <label for="_wm_number_of_posts">'.__('form.number_of_posts').'</label>
            <input type="number" min="0" class="form-control" id="_wm_number_of_posts" name="number_of_posts" value="'.$data['number_of_posts'].'">
        </div>';
    }
    
    /**
     * carouselInput
     *
     * @param  mixed $data
     * @return void
     */
    public function carouselInput($data) {
        $html = '<div id="_wm_carousel_el" class="form-group">
            <label for="_wm_carousel">'.__('form.carousel').'</label>
            <select id="_wm_carousel" name="carousel" class="form-control" data-placeholder="'.__('form.select').'" style="width: 100%">';
        if ($data['carousel'] == 'true') {
            $html .= '<option value="true" selected>'.__('form.yes').'</option>
                    <option value="false">'.__('form.no').'</option>';
        } else {
            $html .= '<option value="true">'.__('form.yes').'</option>
                    <option value="false" selected>'.__('form.no').'</option>';
        }
        $html .= '</select>
            </div>';

        return $html;
    }
    
    /**
     * carouselAutoplayInput
     *
     * @param  mixed $data
     * @return void
     */
    public function carouselAutoplayInput($data) {
        $html = '<div id="_wm_carousel_autoplay_el" class="form-group">
            <label for="_wm_carousel_autoplay">'.__('form.carousel_autoplay').'</label>
            <select id="_wm_carousel_autoplay" name="carousel_autoplay" class="form-control" data-placeholder="'.__('form.select').'" style="width: 100%">';
        if ($data['carousel_autoplay'] == 'true') {
            $html .= '<option value="true" selected>'.__('form.yes').'</option>
                                <option value="false">'.__('form.no').'</option>';
        } else {
            $html .= '<option value="true">'.__('form.yes').'</option>
                                <option value="false" selected>'.__('form.no').'</option>';
        }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * termTypeInput
     *
     * @param  mixed $data
     * @return void
     */
    public function termTypeInput($data) {
        $html = '<div id="_wm_term_el" class="form-group">
                        <label for="_wm_term">' . __('form.term') . '</label>
                        <select id="_wm_term" class="form-control" name="term_type">';
                if ($data['term_type'] == 'category') {
                    $html .= '<option value="category" selected>' . __('form.category') . '</option>
                            <option value="tags">' . __('form.tags') . '</option>';
                } else {
                    $html .= '<option value="category">' . __('form.category') . '</option>
                            <option value="tags" selected>' . __('form.tags') . '</option>';
                }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * adTypeInput
     *
     * @param  mixed $data
     * @return void
     */
    public function adTypeInput($data) {
        $googleAdsense = [
            'google_adsense' => 'Google Adsense',
            'image' => 'Image',
            'script' => 'Script'
        ];

        $html = '<div id="_wm_ad_type_el" class="form-group">
            <label for="_wm_ad_type">'.__('form.ad_type').'</label>
            <select id="_wm_ad_type" class="form-control" name="ad_type">';
                foreach ($googleAdsense as $i => $ad) {
                    if ($i == $data['ad_type']) {
                        $html .= '<option value="'.$i.'" selected>'.__($ad).'</option>';
                    } else {
                        $html .= '<option value="'.$i.'">'.__($ad).'</option>';
                    }
                }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * gaClientInput
     *
     * @param  mixed $data
     * @return void
     */
    public function gaClientInput($data) {
        return '<div id="_wm_ga_client_el" class="form-group d-none">
            <label for="_wm_ga_client">'.__('form.ga_client').'</label>
            <input id="_wm_ga_client" type="text" class="form-control" name="ga_client" value="'.$data['ga_client'].'">
        </div>';
    }
    
    /**
     * gaSlotInput
     *
     * @param  mixed $data
     * @return void
     */
    public function gaSlotInput($data) {
        return '<div id="_wm_ga_slot_el" class="form-group d-none">
            <label for="_wm_ga_slot">'.__('form.ga_slot').'</label>
            <input id="_wm_ga_slot" type="text" class="form-control" name="ga_slot" value="'.$data['ga_slot'].'">
        </div>';
    }
    
    /**
     * gaSizeInput
     *
     * @param  mixed $data
     * @return void
     */
    public function gaSizeInput($data) {
        $sizes = ['fixed' => 'Fixed', 'responsive' => 'Responsive'];

        $html = '<div id="_wm_ga_size_el" class="form-group d-none">
            <label for="_wm_ga_size">'.__('form.ga_size').'</label>
            <select id="_wm_ga_size" class="form-control" name="ga_size">';
                foreach ($sizes as $i => $size) {
                    if ($i == $data['ga_size']) {
                        $html .= '<option value="'.$i.'" selected>'.__($size).'</option>';
                    } else {
                        $html .= '<option value="'.$i.'">'.__($size).'</option>';
                    }
                }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * gaFormatInput
     *
     * @param  mixed $data
     * @return void
     */
    public function gaFormatInput($data) {
        $format = [
            'auto' => 'Auto',
            'rectangle' => 'Rectangle',
            'vertical' => 'Vertical',
            'horizontal' => 'Horizontal'
        ];

        $html = '<div id="_wm_ga_format_el" class="form-group d-none">
            <label for="_wm_ga_format">'.__('form.ga_format').'</label>
            <select id="_wm_ga_format" class="form-control" name="ga_format">';
                foreach ($format as $i => $value) {
                    if ($i == $data['ga_format']) {
                        $html .= '<option value="'.$i.'" selected>'.__($value).'</option>';
                    } else {
                        $html .= '<option value="'.$i.'">'.__($value).'</option>';
                    }
                }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * gaFullWidthResponsiveInput
     *
     * @param  mixed $data
     * @return void
     */
    public function gaFullWidthResponsiveInput($data) {
        $html = '<div id="_wm_ga_full_width_responsive_el" class="form-group d-none">
            <label for="_wm_ga_full_width_responsive">'.__('form.full_width_responsive').'</label>
            <select id="_wm_ga_full_width_responsive" class="form-control" name="ga_full_width_responsive">';
        if ($data['ga_full_width_responsive'] == 'true') {
            $html .= '<option value="true" selected>'.__('form.yes').'</option>
                    <option value="false">'.__('form.no').'</option>';
        } else {
            $html .= '<option value="true">'.__('form.yes').'</option>
                    <option value="false" selected>'.__('form.no').'</option>';
        }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * adImageInput
     *
     * @param  mixed $data
     * @return void
     */
    public function adImageInput($data) {
        $image = '';
        $ready = '';

        if ($data['ad_image']) {
            $exists = $this->diskStorage()->exists('ad/' . $data['ad_image']);
            if ($exists) {
                $ready = 'ready';
                $image  = $this->getBlobImage('ad', $data['ad_image']);
            }
        }

        return '<div id="_wm_ad_image_el" class="form-group d-none">
            <label for="_wm_ad_image">'.__('form.ad_image').'</label>
            <div class="upload-image row justify-content-md-center '.$ready.'">
                <input id="upload" type="file" name="ad_image" accept="image/*"
                       data-role="none" hidden>
                <div class="col-12 col-md-8 text-center">
                    <div class="upload-msg">'.__('form.click_to_upload_image').'</div>
                    <div id="display">
                        <img id="image_preview_container" src="'.$image.'" alt="'.__('form.preview_image').'"
                             style="max-width: 100%;">
                    </div>
                    <div class="buttons text-center mt-3">
                        <button id="reset" type="button" class="reset btn btn-danger">'.__('button.change_image').'</button>
                    </div>
                </div>
            </div>
        </div>';
    }
    
    /**
     * adSizeInput
     *
     * @param  mixed $data
     * @return void
     */
    public function adSizeInput($data) {
        return '<div id="_wm_ad_size_el" class="form-group d-none">
            <label for="_wm_ad_size">'.__('form.ad_size').'</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="number" name="ad_width" class="form-control" placeholder="'.__('form.placeholder_width').'" value="'.$data['ad_width'].'">
                        <div class="input-group-append">
                            <span class="input-group-text">px</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="input-group mb-3">
                        <input type="number" name="ad_height" class="form-control" placeholder="'.__('form.placeholder_height').'" value="'.$data['ad_height'].'">
                        <div class="input-group-append">
                            <span class="input-group-text">px</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
    
    /**
     * adUrlInput
     *
     * @param  mixed $data
     * @return void
     */
    public function adUrlInput($data) {
        return ' <div id="_wm_ad_url_el" class="form-group d-none">
            <label for="_wm_ad_url">'.__('form.ad_url').'</label>
            <input id="_wm_ad_url" type="text" class="form-control" name="ad_url" value="'.$data['ad_url'].'">
        </div>';
    }
    
    /**
     * adScriptInput
     *
     * @param  mixed $data
     * @return void
     */
    public function adScriptInput($data) {
        return '<div id="_wm_ad_script_el" class="form-group d-none">
            <label for="_wm_ad_script">'.__('form.ad_script').'</label>
            <textarea name="ad_script" id="_wm_ad_script" class="form-control" rows="5">'.$data['ad_script'].'</textarea>
        </div>';
    }
    
    /**
     * logoAboutInput
     *
     * @param  mixed $data
     * @return void
     */
    public function logoAboutInput($data) {
        $html = '<div id="_wm_logo_el" class="form-group">
            <label for="_wm_logo">'.__('form.logo').'</label>
            <select id="_wm_logo" class="form-control" name="logo">';
                if ($data['logo'] == 'true') {
                    $html .= '<option value="true" selected>'.__('form.show').'</option>
                            <option value="false">'.__('form.hide').'</option>';
                } else {
                    $html .= '<option value="true">'.__('form.show').'</option>
                            <option value="false" selected>'.__('form.hide').'</option>';
                }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * linkAboutInput
     *
     * @param  mixed $data
     * @return void
     */
    public function linkAboutInput($data) {
        $html = '<div id="_wm_link_el" class="form-group">
            <label for="_wm_link">'.__('form.link').'</label>
                <select id="_wm_link" class="form-control" name="link">';
                if ($data['link'] == 'true') {
                    $html .= '<option value="true" selected>'.__('form.show').'</option>
                        <option value="false">'.__('form.hide').'</option>';
                } else {
                     $html .= '<option value="true">'.__('form.show').'</option>
                        <option value="false" selected>'.__('form.hide').'</option>';
                }
        $html .= '</select>
        </div>';

        return $html;
    }
    
    /**
     * disqusInput
     *
     * @param  mixed $data
     * @return void
     */
    public function disqusInput($data) {
        return '<div id="_disqus_el" class="form-group">
        <label for="_disqus">'.__('form.disqus_shortname').'</label>
        <input id="_disqus" type="text" class="form-control" name="disqus_short_name" value="'.$data['disqus_short_name'].'">
        </div>';
    }
    
    /**
     * googleMapCodeInput
     *
     * @return void
     */
    public function googleMapCodeInput($data) {
        return '<div id="_google_map_code_el" class="form-group">
        <label for="_google_map_code">' . __('form.google_map_code') . '</label>
        <textarea name="google_map_code" id="_google_map_code" class="form-control" rows="5">' . $data['google_map_code'] . '</textarea>
        </div>';
    }
}
