# soen341 Section UUUB Group UB10
[Sprint 1](https://docs.google.com/spreadsheets/d/1gs0IDbbtNSP9LggcaedKTVtoTRCYKRJFTi9f7vs37ng/edit#gid=0)

Team Members:
```
Abdulrahim Mansour - abdulmansour
Tommy Soucy - TommySoucy
Ahmed Al-Naseri - Ahmed-alnaseri
Mark Said - marksman1298



```
Framework/Language: Laravel/PHP

## Objective:
The group is tasked with implementing a simplified version of Instagram. The team will collaborate to build this project to meet the
guidlines of the S/W process learned in class. The team was provided with 3 core features to which more sub-features will be added.


## Core Features:
* Posting a picture with text description
* Following a user
* Leave comments to a posted picture

## Setup:

1. Download, Install and Run XAMPP: 
[mac](https://www.apachefriends.org/xampp-files/7.3.13/xampp-osx-7.3.13-0-installer.dmg)
[windows](https://www.apachefriends.org/xampp-files/7.3.13/xampp-windows-x64-7.3.13-0-VC15-installer.exe)

2. [Environment Setup](https://medium.com/laravel-power-devs/collaborative-development-with-laravel-f32a84040677) steps 1 to 4

3. Run the following commands outside …/htdocs/soen341: (for mac)
```
sudo chmod 777 Applications/XAMPP/xamppfiles/htdocs/soen341/storage/logs
sudo chmod 777 Applications/XAMPP/xamppfiles/htdocs/soen341/storage/framework/views
sudo chmod 777 Applications/XAMPP/xamppfiles/htdocs/soen341/storage/framework/sessions
```
Screenshots of 6 User Stories:

US-01: As a User I would like to register and Login:
This is the Registration Page:
![register_page](https://user-images.githubusercontent.com/48803193/78802193-89f26280-798b-11ea-866d-6bf3075e3fbd.png)

This is the Login Page:
![login_page](https://user-images.githubusercontent.com/48803193/78802576-fe2d0600-798b-11ea-960b-a1efdd4413d9.png)

This is the Logout Page:
![logout](https://user-images.githubusercontent.com/48803193/78802616-08e79b00-798c-11ea-8dcf-78e5d9d41ec7.png)

US-02: As a user, I would like to create, edit, view a post which contains a picture with title and body

This is the Create a Post page:
![create_post](https://user-images.githubusercontent.com/48803193/78802797-39c7d000-798c-11ea-841c-5626feaebe63.png)

This is the created Post, with the option to edit or delete the Post (only the author of the post can edit/delete):
![post_info](https://user-images.githubusercontent.com/48803193/78802943-64198d80-798c-11ea-8bde-54fa1ab361b9.png)

The Posts of all users appear in a feed:
![feed_posts](https://user-images.githubusercontent.com/48803193/78803129-9cb96700-798c-11ea-9344-5eedb3c4676d.png)

This is what the posts look like:

![posts](https://user-images.githubusercontent.com/48803193/78803297-d25e5000-798c-11ea-99cc-336af260e172.png)

US-03: US-03 As a User, I would like to follow another User

This is the following page:
![follow_page](https://user-images.githubusercontent.com/48803193/78803470-0d608380-798d-11ea-9117-d8684140a820.png)

Users have the option to follow and unfollow other users
![follow-unfollow](https://user-images.githubusercontent.com/48803193/78803781-67f9df80-798d-11ea-91b9-0bf071f12202.png)

US-04: As a User I want to comment on posted picture

Users have the option to comment on posts, reply to other comments, edit and delete their comments.
![post_comments](https://user-images.githubusercontent.com/48803193/78804100-be671e00-798d-11ea-885f-7c41984a0f58.png)

US-05: US-05 As a user, I want to be able to "like" posts

Users have the option to like/unlike posts of other users:
![like_post_in_feed](https://user-images.githubusercontent.com/48803193/78804305-fa01e800-798d-11ea-9af9-8fbaba48d390.png)

US-06: Create a list of ads based on the most frequently used words in the Posts
Users will see targeted adds based on their posts descriptions.
![posts_+_ads](https://user-images.githubusercontent.com/48803193/78804512-35041b80-798e-11ea-8b3b-498ddcaa6d4e.png)

![pagination](https://user-images.githubusercontent.com/48803193/78804851-a8a62880-798e-11ea-937e-42a4a301a027.png)
