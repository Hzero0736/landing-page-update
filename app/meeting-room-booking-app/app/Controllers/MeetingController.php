<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MeetingroomModel;
use App\Models\MeetingModel;
use App\Models\UserModel;

class MeetingController extends BaseController
{
    protected $meetingroomModel;
    protected $meetingModel;
    protected $userModel;

    public function __construct()
    {
        $this->meetingroomModel = new MeetingroomModel();
        $this->meetingModel = new MeetingModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $meetings = $this->meetingModel->getMeetings();

        $calendarEvents = array_map(function ($meeting) {
            return [
                'id' => $meeting['id'] ?? null,
                'title' => $meeting['title'] ?? '',
                'date' => $meeting['date'] ?? '',
                'start' => ($meeting['date'] ?? '') . ' ' . ($meeting['start_time'] ?? ''),
                'end' => ($meeting['date'] ?? '') . ' ' . ($meeting['end_time'] ?? ''),
                'description' => $meeting['description'] ?? '',
                'room' => $meeting['room_name'] ?? '',
                'room_id' => $meeting['room_id'] ?? null,
                'users' => $meeting['users'] ?? '',
                'repeat' => $meeting['repeat'] ?? 'none'
            ];
        }, $meetings);

        $data = [
            'rooms' => $this->meetingroomModel->getMeetingRooms(),
            'meetings' => $calendarEvents,
            'users' => $this->userModel->findAll(),
        ];

        return view('layout/header', $data)
            . view('booking_meeting/main_menu', $data)
            . view('booking_meeting/form', $data)
            . view('booking_meeting/form_room', $data)
            . view('booking_meeting/form_user', $data)
            . view('layout/footer', $data);
    }

    public function save()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'date' => 'required|valid_date',
            'start_time' => 'required',
            'end_time' => 'required',
            'room_id' => 'required|numeric',
            'description' => 'required',
            'user' => 'required',
            'repeat' => 'permit_empty|in_list[none,daily,weekly,monthly]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $date = $this->request->getPost('date');
        $start_time = $this->request->getPost('start_time');
        $end_time = $this->request->getPost('end_time');
        $room_id = $this->request->getPost('room_id');
        $repeat = $this->request->getPost('repeat') ?? 'none';

        $dates = [];
        $startDate = new \DateTime($date);

        switch ($repeat) {
            case 'daily':
                for ($i = 0; $i < 5; $i++) {
                    $dates[] = $startDate->format('Y-m-d');
                    $startDate->modify('+1 day');
                }
                break;

            case 'weekly':
                for ($i = 0; $i < 4; $i++) {
                    $dates[] = $startDate->format('Y-m-d');
                    $startDate->modify('+1 week');
                }
                break;

            case 'monthly':
                for ($i = 0; $i < 12; $i++) {
                    $dates[] = $startDate->format('Y-m-d');
                    $startDate->modify('+1 month');
                }
                break;
            default:
                $dates[] = $date;
        }

        foreach ($dates as $bookingDate) {
            $existingMeeting = $this->meetingModel
                ->where('room_id', $room_id)
                ->where('date', $bookingDate)
                ->groupStart()
                ->where("('$start_time' BETWEEN start_time AND end_time)")
                ->orWhere("('$end_time' BETWEEN start_time AND end_time)")
                ->orWhere("(start_time BETWEEN '$start_time' AND '$end_time')")
                ->orWhere("(end_time BETWEEN '$start_time' AND '$end_time')")
                ->groupEnd()
                ->first();

            if ($existingMeeting) {
                continue;
            }

            $data = [
                'title' => $this->request->getPost('title'),
                'date' => $bookingDate,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'room_id' => $room_id,
                'description' => $this->request->getPost('description'),
                'user' => $this->request->getPost('user'),
                'repeat' => $repeat
            ];

            $this->meetingModel->insert($data);
        }

        return redirect()->to('booking')->with('success', 'Booking ruang rapat berhasil');
    }

    public function delete($id)
    {
        $this->meetingModel->delete($id);
        return redirect()->to('booking')->with('success', 'Booking ruang rapat berhasil dihapus');
    }

    public function edit($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required|min_length[3]|max_length[255]',
            'date' => 'required|valid_date',
            'start_time' => 'required',
            'end_time' => 'required',
            'room_id' => 'required|numeric',
            'description' => 'required',
            'user' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $date = $this->request->getPost('date');
        $start_time = $this->request->getPost('start_time');
        $end_time = $this->request->getPost('end_time');
        $room_id = $this->request->getPost('room_id');

        $existingMeeting = $this->meetingModel
            ->where('room_id', $room_id)
            ->where('date', $date)
            ->where('id !=', $id)
            ->groupStart()
            ->where("('$start_time' BETWEEN start_time AND end_time)")
            ->orWhere("('$end_time' BETWEEN start_time AND end_time)")
            ->orWhere("(start_time BETWEEN '$start_time' AND '$end_time')")
            ->orWhere("(end_time BETWEEN '$start_time' AND '$end_time')")
            ->groupEnd()
            ->first();

        if ($existingMeeting) {
            return redirect()->back()->withInput()->with('error', 'Ruang rapat sudah dibooking untuk waktu tersebut');
        }

        if (strtotime($end_time) <= strtotime($start_time)) {
            return redirect()->back()->withInput()->with('error', 'Waktu selesai harus lebih besar dari waktu mulai');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'room_id' => $room_id,
            'description' => $this->request->getPost('description'),
            'user' => $this->request->getPost('user')
        ];

        $this->meetingModel->update($id, $data);
        return redirect()->to('/booking')->with('success', 'Booking ruang rapat berhasil diubah');
    }
}