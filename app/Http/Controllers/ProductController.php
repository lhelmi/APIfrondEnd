<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    public function home()
    {
        $client = new Client();
        $res = $client->request('GET', 'http://localhost:8000/product');
        
        $response = [
            'message' => 'List data',
            'data' => json_decode($res->getBody()->getContents()),
        ];

        return response()->json($response);
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
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:8000/product', [
            'form_params' => [
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock
            ]
        ]);
        
        return response()->json(json_decode($res->getBody()->getContents()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/product/']);
        $res = $client->request('GET', $id);
        
        return response()->json(json_decode($res->getBody()->getContents()));
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
        $client = new Client([
            'base_uri' => 'http://localhost:8000/product/',
            'form_params' => [
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock
            ]
        ]);
        $res = $client->request('PUT', $id);
        
        return response()->json(json_decode($res->getBody()->getContents()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
