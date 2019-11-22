<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Marker;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 'index';
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Marker = new Marker();
        $markers = $request->input('markers');
        foreach ($markers as $marker) {
            preg_match_all('/^[0-9a-z-\.]+\@[0-9a-z-]{2,}\.[a-z]{2,}$/i', $marker['email'], $emails);
            if (!$emails[0]) {
                echo 'валидный E-mail не найден в поле E-mail';
                die();
            }
            $marker['email'] = $emails[0][0];
            $validator = Validator::make(
                $marker,
                [
                    'email' => 'required|string|max:50',
                    'comment' => 'required|string|max:50'
                ]
            );
            if ($validator->fails()) {
                echo 'Введены некорректные данные';
            } else {
                $Marker->email = $marker['email'];
                $Marker->comment = $marker['comment'];
                $Marker->latlng = json_encode($marker['latlng']);
                $Marker->category = $marker['category'];
                try {
                    $Marker->save();
                } catch (Exception $ex) {
                    echo 'Произошла ошибка при добавлении маркера: ' . $ex->getMessage();
                }
                echo 'Новые маркеры успешно добавлены!';
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        echo 'show';
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singlmarker = Marker::orderBy('id', 'ASC')->first();
        try {
            $singlmarker->delete();
        } catch (Exception $ex) {
            echo 'Произошла ошибка при удалении маркера: ' . $ex->getMessage();
        }
    }
}
