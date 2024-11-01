<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MeetingModel;

class Home extends BaseController
{
    protected $meetingModel;

    public function __construct()
    {
        $this->meetingModel = new MeetingModel();
    }

    public function index()
    {
        echo view('layout/header');
        echo view('landing_page/index');
        echo view('layout/footer');
    }

    public function public()
    {
        $meetings = $this->meetingModel->getMeetings();
        $calendarEvents = array_map(function ($meeting) {
            return [
                'id' => $meeting['id'],
                'title' => $meeting['title'],
                'date' => $meeting['date'],
                'start' => $meeting['date'] . ' ' . $meeting['start_time'],
                'end' => $meeting['date'] . ' ' . $meeting['end_time'],
                'description' => $meeting['description'],
                'room' => $meeting['room_name'],
                'room_id' => $meeting['room_id'],
                'user' => $meeting['user'],
                'repeat' => $meeting['repeat']
            ];
        }, $meetings);
        $data = [
            'rooms' => $this->meetingModel->getMeetings(),
            'meetings' => $calendarEvents,
        ];
        echo view('layout/header');
        echo view('booking_meeting/public', $data);
        // echo view('booking_meeting/form', $data);
        echo view('layout/footer');
    }
}
