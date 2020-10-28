### How to create a new theme?

1. Create a folder with your new theme name.
2. Copy the files you wanna overwrite or replace from `resources/views` into your theme folder.
3. They need to have the same path + name!
4. Go into the `.env` file.
5. Change your `APP_THEME=` to your new created theme name.
6. Run the following commands
    ```bash
    php artisan config:clear && php artisan view:clear && php artisan cache:clear
    ```
7. You are good to go.

### Do you have some special Javascript or Styles?

You can create a new folder into `public/themes/` with your theme name.
After that you can change the {{ asset() }} from your theme file into the one from the created javascript / css folder. 

