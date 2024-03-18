<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $readPosts   = Permission::create(['name' => 'read-posts']);
        $addPosts    = Permission::create(['name' => 'add-posts']);
        $updatePosts = Permission::create(['name' => 'update-posts']);
        $deletePosts = Permission::create(['name' => 'delete-posts']);

        $readPrivatePost   = Permission::create(['name' => 'read-private-post']);
        $addPrivatePost    = Permission::create(['name' => 'add-private-post']);
        $updatePrivatePost = Permission::create(['name' => 'update-private-post']);
        $deletePrivatePost = Permission::create(['name' => 'delete-private-post']);

        $readCategories   = Permission::create(['name' => 'read-categories']);
        $addCategories    = Permission::create(['name' => 'add-categories']);
        $updateCategories = Permission::create(['name' => 'update-categories']);
        $deleteCategories = Permission::create(['name' => 'delete-categories']);

        $readTags   = Permission::create(['name' => 'read-tags']);
        $addTags    = Permission::create(['name' => 'add-tags']);
        $updateTags = Permission::create(['name' => 'update-tags']);
        $deleteTags = Permission::create(['name' => 'delete-tags']);

        $readPages   = Permission::create(['name' => 'read-pages']);
        $addPages    = Permission::create(['name' => 'add-pages']);
        $updatePages = Permission::create(['name' => 'update-pages']);
        $deletePages = Permission::create(['name' => 'delete-pages']);

        $readContacts   = Permission::create(['name' => 'read-contacts']);
        $addContacts    = Permission::create(['name' => 'add-contacts']);
        $updateContacts = Permission::create(['name' => 'update-contacts']);
        $deleteContacts = Permission::create(['name' => 'delete-contacts']);

        $readMenus   = Permission::create(['name' => 'read-menus']);
        $addMenus    = Permission::create(['name' => 'add-menus']);
        $updateMenus = Permission::create(['name' => 'update-menus']);
        $deleteMenus = Permission::create(['name' => 'delete-menus']);

        $readThemes   = Permission::create(['name' => 'read-themes']);
        $addThemes    = Permission::create(['name' => 'add-themes']);
        $updateThemes = Permission::create(['name' => 'update-themes']);
        $deleteThemes = Permission::create(['name' => 'delete-themes']);

        $readLanguage   = Permission::create(['name' => 'read-languages']);
        $addLanguage    = Permission::create(['name' => 'add-languages']);
        $updateLanguage = Permission::create(['name' => 'update-languages']);
        $deleteLanguage = Permission::create(['name' => 'delete-languages']);

        $readAds   = Permission::create(['name' => 'read-ads']);
        $addAds    = Permission::create(['name' => 'add-ads']);
        $updateAds = Permission::create(['name' => 'update-ads']);
        $deleteAds = Permission::create(['name' => 'delete-ads']);

        $readGalleries   = Permission::create(['name' => 'read-galleries']);
        $addGalleries    = Permission::create(['name' => 'add-galleries']);
        $updateGalleries = Permission::create(['name' => 'update-galleries']);
        $deleteGalleries = Permission::create(['name' => 'delete-galleries']);

        $readFilemanager   = Permission::create(['name' => 'read-file-manager']);
        $addFilemanager    = Permission::create(['name' => 'add-file-manager']);
        $updateFilemanager = Permission::create(['name' => 'update-file-manager']);
        $deleteFilemanager = Permission::create(['name' => 'delete-file-manager']);

        $readUsers   = Permission::create(['name' => 'read-users']);
        $addUsers    = Permission::create(['name' => 'add-users']);
        $updateUsers = Permission::create(['name' => 'update-users']);
        $deleteUsers = Permission::create(['name' => 'delete-users']);
        $register    = Permission::create(['name' => 'register-users']);

        $readRoles   = Permission::create(['name' => 'read-roles']);
        $addRoles    = Permission::create(['name' => 'add-roles']);
        $updateRoles = Permission::create(['name' => 'update-roles']);
        $deleteRoles = Permission::create(['name' => 'delete-roles']);

        $readPermissions   = Permission::create(['name' => 'read-permissions']);
        $addPermissions    = Permission::create(['name' => 'add-permissions']);
        $updatePermissions = Permission::create(['name' => 'update-permissions']);
        $deletePermissions = Permission::create(['name' => 'delete-permissions']);

        $readSocialMedia   = Permission::create(['name' => 'read-social-media']);
        $addSocialMedia    = Permission::create(['name' => 'add-social-media']);
        $updateSocialMedia = Permission::create(['name' => 'update-social-media']);
        $deleteSocialMedia = Permission::create(['name' => 'delete-social-media']);

        $readSuperadmin       = Permission::create(['name' => 'read-super-admin']);
        $addSuperadmin        = Permission::create(['name' => 'add-super-admin']);
        $updateSuperadmin     = Permission::create(['name' => 'update-super-admin']);
        $deleteSuperadmin     = Permission::create(['name' => 'delete-super-admin']);
        $editPostSuperadmin   = Permission::create(['name' => 'edit-post-super-admin']);
        $deletePostSuperadmin = Permission::create(['name' => 'delete-post-super-admin']);

        $readAdmin       = Permission::create(['name' => 'read-admin']);
        $addAdmin        = Permission::create(['name' => 'add-admin']);
        $updateAdmin     = Permission::create(['name' => 'update-admin']);
        $deleteAdmin     = Permission::create(['name' => 'delete-admin']);
        $editPstAdmin    = Permission::create(['name' => 'edit-post-admin']);
        $deletePostAdmin = Permission::create(['name' => 'delete-post-admin']);

        $readAuthor       = Permission::create(['name' => 'read-author']);
        $addAuthor        = Permission::create(['name' => 'add-author']);
        $updateAuthor     = Permission::create(['name' => 'update-author']);
        $deleteAuthor     = Permission::create(['name' => 'delete-author']);
        $editPostAuthor   = Permission::create(['name' => 'edit-post-author']);
        $deletePostAuthor = Permission::create(['name' => 'delete-post-author']);

        $readSettings   = Permission::create(['name' => 'read-settings']);
        $updateSettings = Permission::create(['name' => 'update-settings']);

        $readAnalytics   = Permission::create(['name' => 'read-analytics']);

        $readEnv   = Permission::create(['name' => 'read-env']);

        $readProfile   = Permission::create(['name' => 'read-profile']);
        $updateProfile = Permission::create(['name' => 'update-profile']);

        $readTranslation  = Permission::create(['name' => 'read-translations']);
        $updateTranslation = Permission::create(['name' => 'update-translations']);

        $readComments   = Permission::create(['name' => 'read-comments']);
        $addComments    = Permission::create(['name' => 'add-comments']);
        $replyComments    = Permission::create(['name' => 'reply-comments']);
        $updateComments = Permission::create(['name' => 'update-comments']);
        $approveComments = Permission::create(['name' => 'approve-comments']);
        $deleteComments = Permission::create(['name' => 'delete-comments']);


        // Role
        Role::create(['name' => 'super-admin'])->givePermissionTo(Permission::all());

        Role::create(['name' => 'admin'])->givePermissionTo([
            $readPosts, $addPosts, $updatePosts, $deletePosts,
            $readPrivatePost, $addPrivatePost, $updatePrivatePost, $deletePrivatePost,
            $readCategories, $addCategories, $updateCategories, $deleteCategories,
            $readTags, $addTags, $updateTags, $deleteTags,
            $readPages, $addPages, $updatePages, $deletePages,
            $readContacts, $addContacts, $updateContacts, $deleteContacts,
            $readMenus, $addMenus, $updateMenus, $deleteMenus,
            $readThemes, $addThemes, $updateThemes, $deleteThemes,
            $readLanguage, $addLanguage, $updateLanguage, $deleteLanguage,
            $readAds, $addAds, $updateAds, $deleteAds,
            $readGalleries, $addGalleries, $updateGalleries, $deleteGalleries,
            $readFilemanager, $addFilemanager, $updateFilemanager, $deleteFilemanager,
            $readUsers, $addUsers, $updateUsers, $deleteUsers,
            $readRoles, $addRoles, $updateRoles, $deleteRoles,
            $readPermissions, $addPermissions, $updatePermissions, $deletePermissions,
            $readSocialMedia, $addSocialMedia, $updateSocialMedia, $deleteSocialMedia,
            $readRoles, $addRoles, $updateRoles, $deleteRoles,
            $readAuthor, $addAuthor, $updateAuthor, $deleteAuthor, $editPostAuthor, $deletePostAuthor,
            $readSettings, $updateSettings,
            $register,
            $readAnalytics,
            $readProfile, $updateProfile,
            $readTranslation, $updateTranslation,
            $readComments, $addComments, $replyComments, $updateComments, $approveComments, $deleteComments]);

        Role::create(['name' => 'author'])->givePermissionTo([
            $readPosts, $addPosts, $updatePosts, $deletePosts,
            $updateUsers,
            $readProfile, $updateProfile,
            $readComments, $addComments, $updateComments, $deleteComments]);
    }
}
