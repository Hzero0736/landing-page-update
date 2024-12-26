# meeting-room-booking-app/meeting-room-booking-app/README.md

# Meeting Room Booking Application

This project is a web-based application for booking meeting rooms. It allows users to view available rooms, create bookings, and manage room and user data.

## Project Structure

The project is organized as follows:

```
meeting-room-booking-app
├── app
│   ├── Controllers
│   │   ├── MeetingController.php
│   │   ├── RoomController.php
│   │   └── UserController.php
│   ├── Models
│   │   ├── MeetingModel.php
│   │   ├── MeetingroomModel.php
│   │   └── UserModel.php
│   ├── Views
│   │   ├── booking_meeting
│   │   │   ├── main_menu.php
│   │   │   ├── form.php
│   │   │   ├── form_room.php
│   │   │   └── form_user.php
│   │   ├── layout
│   │   │   ├── header.php
│   │   │   └── footer.php
│   │   └── partials
│   │       ├── alert_messages.php
│   │       ├── calendar.php
│   │       ├── meeting_rooms_card.php
│   │       └── users_card.php
├── public
│   ├── css
│   │   └── styles.css
│   ├── js
│   │   └── scripts.js
│   └── index.php
├── routes
│   └── Routes.php
├── .env
├── composer.json
├── composer.lock
└── README.md
```

## Features

- **Meeting Management**: Create, edit, and delete meetings.
- **Room Management**: Add, edit, and delete meeting rooms.
- **User Management**: Add new users and manage existing users.
- **Calendar View**: Visual representation of bookings in a calendar format.

## Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   ```

2. Navigate to the project directory:
   ```
   cd meeting-room-booking-app
   ```

3. Install dependencies using Composer:
   ```
   composer install
   ```

4. Set up your environment variables in the `.env` file.

5. Run the application:
   ```
   php spark serve
   ```

## Usage

- Access the application in your web browser at `http://localhost:8080`.
- Use the navigation to manage meetings, rooms, and users.

## Contributing

Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License

This project is licensed under the MIT License. See the LICENSE file for details.