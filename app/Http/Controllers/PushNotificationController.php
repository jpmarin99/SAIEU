<?php

namespace App\Http\Controllers;

use App\PushNotification;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */

    public function index()
    {

        $push_notifications = PushNotification::orderBy('created_at', 'desc')->get();
        return view('notification.index', compact('push_notifications'));
    }
    public function bulksend(Request $req){

        $comment = new PushNotification();
        $comment->title = $req->input('title');
        $comment->body = $req->input('body');
        $comment->img = $req->input('img');
        $comment->save();



        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $req->id,'status'=>"done");
        $notification = array('title' =>$req->title, 'body' => $req->body, 'image'=> $req->img, 'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('to' => "/topics/all", 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
        $fields = json_encode ($arrayToSend);
        $SERVER_API_KEY = 'AAAAuR-UQis:APA91bFEW2MtVJvdck_cQ0Z_piqq6mv1JfPnYRo29nXl5Za4soqDAEikqLweKi_TJuquGqgg6FxNXwDRjbe5tlTIvejWANdZpEQeAj4xAcvvuEWmlDj0TP1an8yl5qUBeT6jEWQPfTwN';;
        $headers = array (
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

        $result = curl_exec ( $ch );
        dd($result);
        curl_close ( $ch );
        //return redirect()->back()->with('success', 'Notification Send successfully');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function show(PushNotification $pushNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(PushNotification $pushNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PushNotification $pushNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(PushNotification $pushNotification)
    {
        //
    }
}
