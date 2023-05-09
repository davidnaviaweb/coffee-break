<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCard;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class CardController
 * @package App\Http\Controllers
 */
class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::orderBy('updated_at', 'desc')->paginate();
        $users = User::all();

        return view('cards.index', compact('cards', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCard $request)
    {
        Card::create($request->all());

        return redirect()->route('cards.index')
            ->withSuccess(__('Card created successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = Card::find($id);
        $users = User::all();
        $stati = Card::STATI;

        return view('cards.edit', compact('card', 'users', 'stati'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCard $request, Card $card)
    {
        $card->update($request->all());

        return redirect()->route('cards.index')
            ->with('success', 'Card updated successfully');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $card = Card::find($id)->delete();

        return redirect()->route('cards.index')
            ->with('success', 'Card deleted successfully');
    }

    /**
     * @return string
     */
    public final static function getNewSerialNumber(): string
    {
        $newSerialNumber = rand(0, 4294967295);
        $serialNumbers = Card::all('serial_number')->toArray();
        while (in_array($newSerialNumber, $serialNumbers)) {
            $newSerialNumber = rand(0, 4294967295);
        }

        return str_pad($newSerialNumber, Card::SERIAL_NUMBER_LENGTH, '0', STR_PAD_LEFT);;
    }
}
