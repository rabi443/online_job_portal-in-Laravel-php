##Note by rabin chaudhary

## Send email

inside .env file configure:

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com (like rc2583463@gmail.com)
MAIL_PASSWORD=your-app-password (like wbbsbrllvxeesumq )
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com (like rc2583463@gmail.com)
MAIL_FROM_NAME="Your App Name" (like job portal platform)

Test Email Sending Run this command to test email sending:

php artisan tinker

Then type:

Mail::raw('This is a test email', function($message) {
    $message->to('your-email@gmail.com')->subject('Test Email');
});

If your Gmail is set up correctly, you should receive the email.

##


# Steps to push your project whole folder in github.
step-1: Create repository.

step-2: In your terminal or command prompt, go to your project directory then, 
        run command : git init

step-3: Add GitHub Remote Repository
        Copy the remote URL from GitHub (e.g., https://github.com/username/project_name.git), and 
        run command : git remote add origin https://github.com/username/project_name.git

step-4: Make sure your project has a .gitignore file, if not, create one and add this:
        /vendor
        /node_modules
        .env
        .DS_Store
        /public/storage
        /storage/*.key
        .idea

step-5: Commit and Push Your Code by command:
        git add .
        git commit -m "Initial commit of Laravel project"
        git branch -M main
        git push -u origin main

# Once you’ve made changes to any file in your project and want to update them on GitHub, just follow these simple steps:

step-1: To stage all modified files, run command : git add .
        OR
        To stage just the file marked M, run command : git add file_Path

step-2:  Commit the Change 
        run command : git commit -m "your message "

step-3:  Push to GitHub
        run command : git push origin main

# Bonus Tip:
To check the meaning of Git status codes: 
        run command : git status

