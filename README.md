<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/quarkmarino/notifications.test">
    <img src="logo.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">A full stack demo project of a notifications with Laravel, Livewire and VueJs</h3>

  <p align="center">
    Notification Test Demo Site
    <br />
    <a href="http://marianoescalera.me/login">View Demo</a>
  </p>
</p>

<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li><a href="#categories-and-channels">Categories & Channels</a></li>
    <li><a href="#notification-types">Notification Types</a></li>
    <li><a href="#stubbing-and-logging">Stubbing & Logging</a></li>
    <li><a href="#users">Users</a></li>
    <li><a href="#notifications-form">Notifications Form</a></li>
    <li><a href="#evaluations">Evaluations</a></li>
    <li><a href="#instalation">Installation</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

# Categories & Channels
Have to create a notification system that has the ability to receive a message and depending on the
category and subscribers, notify these users in the channels they are registered.
It will be 3 message categories:
▪ Sports
▪ Finance
▪ Movies

# Notification Types
And there will be 3 types of notifications, each type should have its own class to manage the logic of
sending the message independently.
▪ SMS
▪ E-Mail
▪ Push Notification

# Stubbing & Logging
No message will actually be sent or the need to communicate with any external APIs, only will register
the sent notification in an archive of Logs or in a database.
In the log, it will need to save all the information necessary to identify that the notification has been
sent correctly to the respective subscriber,such asthe type of message, type of notification, user data,
time, etc.

# Users
No user administration is required, you can use a Mock of users in the source code, and they must
have the following information:
• ID
• Name
• Email
• Phone number
• Subscribed [ ] here you need to list all the categories where the user is subscribed
• Channels [ ] a list of the notification's channels (SMS | E-Mail | Push Notification)

# Notifications Form
As user interface you need to display 2 main elements.
1. Submission form. A simple form to send the message, which will have 2 fields:
• Category. List of available categories.
• Message. Text area, only validate that the message is not empty.
2. Log history. A list of all records in the log, sorted from newest to oldest.

# Evaluations
We will evaluate:
• Architecture of the application and software design patterns.
• OOP and Scalability (ready to add more types of notifications).
• Manage requests to the Server by RESTful APIs.
• For the tests, register at least 3 users with different configurations.

# Installation

1. Clone the repo
    ```sh
    git clone https://github.com/quarkmarino/notifications.test
    ```
2. Install Composer dependencies
    ```sh
    cd notifications.test
    composer install
    ```
3. Fire Up Sail (requires Docker)
    ```sh
    sail up -d
    ```
4. Run artisan migrations
    ```sh
    sail art migrate
    ```
5. Run artisan db seeders
    ```sh
    sail art db:seed
    ```
6. Compile Scripts and Styles
    ```sh
    sail yarn run dev
    ```
7. Visit http://notifications.test
    7.1 login with the following credentials
      user: admin@notifications.test
      password: password
    7.1 visit http://notifications.test/livewire
      Post a message from the form (via Livewire)
    7.2 visit http://notifications.test/vuejs
      Post a message from the form (via VueJs)
    6.3 visit http://notifications.test/logs
      Inspect the logs table

# Architecture explanation

## Notification Service
Of course laravel 9 now ships with a full fledged Notification system out of the box,
however a custom implementation was required by the test, it is as follows.

The main "Notification Service" classes are contained within the `app\Services\Notifications` folder

### Contracts
Three contracts must be implemented by the different classes involved
- NotifiableContract
  - Entity Classes that are expected to represent or at least define the destinatary of the Notifications must implement this contract
- NotificationContract
  - Classes that represent a container somehow of the information that the Notifiables should be notified of, must implement this contract
- NotifierContract
  - Notifier Classes that defines the mechanisms to actually send the notifications, connecting to the API, sending data, pushin, logging, broadcasting, etc. should implement this contract

### Notifiers
- BaseNotifier (an abstract class that receives a Notifiable and a Notification instances in its constructor)
  - EmailNotifier (should implements the Email notification mechanics)
  - PushNotifier (should implements the Push notification mechanics)
  - SmsNotifier (should implements the Sms notification mechanics)
  - "WhatEverNotifier" (should implements the WhatEver notification mechanics)

### Traits
- ShouldBeNotified
  - Utilizes the Visitor design pattern to provide the Notifiables with a simple mechanic to get notified themselves via the `notifyBy` method, which expects a Notifier of some type (Email, Push, SMS, ...)
  - It defines a set of methods that provides a terse API to notify the Notifiable by any of the already existing Notifiers, quickly and easily.
- LogNotifications
  - It defines a simple method that Logs the Notifiable and Notification ran by a Notifiers in the DB (just for demostration (logging) purposes of the test).

## Models
- User (Notifiable)
- Message (Notification)

# Getting notified
The process is event driven, i.e. when the Message is `created`, it triggers the MessageCreated Event, for which the SendNotification Listener is listening.

It then runs the "NotifyUsersAction" Action which is actually in charge of fetching the Users and executing the `notifyBy` accodingly to the channels the User has configured.

Since we are actually calling the `notifyByMail`, `notifyByPush` and `notifyBySms` methods that receive the Notification, the propper Notifier (with its respective required Notifiable and Notification instances) class is being instanciated for us automatically and then the `notify` method is being called.

This method just calls the `logNotifyAction` that logs the Notifiable, Notification and Notifier details to the DB (for demo purposes).

# From CLI & Queuing
Since the process is Event driven by the `created` event on the Message (Notification) model, whenever a new Message is stored in the DB, it is automatically used to notify the Users (Notifiables).

In that case even if the Message is created from a CLI command, such as "SendMessageCommand" it will trigger the notification process.

Now it can be easily queued, since the listener is the one calling the NotifyUsersAction, for an unobstrusive Notification sending operation.

# On Enums
PHP8.1 Enums ar fantastic for Categorical data and avoiding sometimes a very small table in the DB, it also provides a simple way to transform and map the actual enums to other practical values, such as the respective icon class or font color, etc. for certain category or channel for example.

<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.

<!-- CONTACT -->
## Contact

Jose Mariano Escalera Sierra - [@quarkmarino](https://twitter.com/quarkmarino) - mariano.pualiu@gmail.com

Project Link: [https://github.com/quarkmarino/notifications.test](https://github.com/quarkmarino/notifications.test)
