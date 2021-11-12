<?php

namespace App\Http\Controllers;

use Auth;
use App\Data;
use App\Merek;
use App\Order;
use App\Favorite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class DataController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = Data::paginate(10);
    return view('admin.data.index', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $merek = Merek::all();
    return view('admin.data.create', compact('merek'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'type' => 'required',
      'price' => 'required',
      'gambar' => 'required'
    ]);

    $gambar = $request->gambar;
    $new_gambar = date('Ymdhis') . "_" . $gambar->getClientOriginalName();

    Data::create([
      'merek_id' => $request->merek_id,
      'type' => $request->type,
      'price' => $request->price,
      'gambar' => 'uploads/data/' . $new_gambar,
    ]);

    $gambar->move('uploads/data/', $new_gambar);

    return redirect()->back()->with('success', 'Postingan Anda Berhasil Disimpan');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $data = Data::findorfail($id);
    $merek = Merek::all();
    $produk = Data::where('merek_id', $data->merek_id)->orderBy('created_at', 'DESC')->limit(5)->get();
    return view('user.show', compact('data', 'merek', 'produk'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = Data::findorfail($id);
    $merek = Merek::all();
    return view('admin.data.edit', compact('data', 'merek'));
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
    $this->validate($request, [
      'price' => 'required',
      'type' => 'required'
    ]);

    $data = Data::findorfail($id);

    if ($request->gambar == true) {
      $gambar = $request->gambar;
      $new_gambar = date('Ymdhis') . "_" . $gambar->getClientOriginalName();
      $gambar->move('uploads/data/', $new_gambar);
      $data_data = [
        'merek_id' => $request->merek_id,
        'type' => $request->type,
        'price' => $request->price,
        'gambar' => 'uploads/data/' . $new_gambar,
      ];
    } else {
      $data_data = [
        'merek_id' => $request->merek_id,
        'price' => $request->price,
        'type' => $request->type,
      ];
    }

    $data->update($data_data);

    return redirect()->back()->with('success', 'Postingan Anda Berhasil Diupdate');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $data = Data::findorfail($id);
    $data->delete();

    return redirect()->back()->with('success', 'Postingan Anda Berhasil Dihapus');
  }

  public function new()
  {
    $data = Data::paginate(10);
    $merek = Merek::all();
    return view('admin.data.index', compact('data', 'merek'));
  }

  public function tampil_hapus()
  {
    $data = Data::onlyTrashed()->paginate(10);
    return view('admin.data.tampil_hapus', compact('data'));
  }

  public function restore($id)
  {
    $data = Data::withTrashed()->where('id', $id)->first();
    $data->restore();

    return redirect()->back()->with('success', 'Postingan Anda Berhasil Direstore');
  }

  public function kill($id)
  {
    $data = Data::withTrashed()->where('id', $id)->first();
    $data->forceDelete();

    return redirect()->back()->with('success', 'Postingan Anda Berhasil Dihapus Secara Permanent');
  }

  public function home()
  {
    $data = Data::orderBy('created_at', 'DESC')->get();
    $basket = Data::orderBy('created_at', 'DESC')->limit(5)->get();
    $merek = Merek::all();
    return view('user.index', compact('data', 'basket', 'merek'));
  }

  public function cart()
  {
    $cart = session()->get('cart');
    $data = Data::paginate(10);

    $this->item['chart'] = $cart;
    $this->item['data'] = $data;

    $merek = Merek::all();
    $produk = Data::orderBy('created_at', 'DESC')->limit(4)->get();

    return view('user.cart', compact('merek', 'produk'));
  }

  public function addToCart($id)
  {
    $data = Data::findorfail($id);

    if (!$data) {
      abort(404);
    }

    $cart = session()->get('cart');

    if (isset($cart[$id])) {
      $cart[$id]['quantity']++;
      session()->put('cart', $cart);
      return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    $cart[$id] = [
      "data_id" => $data->id,
      "name" => $data->type,
      "brand" => $data->merek->name,
      "quantity" => 1,
      "price" => $data->price,
      "photo" => $data->gambar,
    ];

    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Product added to cart successfully!');
  }

  public function update_cart(Request $request)
  {
    if ($request->id && $request->quantity) {
      $cart = session()->get('cart');
      $cart[$request->id]['quantity'] = $request->quantity;
      session()->put('cart', $cart);
      session()->flash('success', 'Cart updated successfully!');
    }
  }

  public function remove(Request $request)
  {
    if ($request->id) {
      $cart = session()->get('cart');

      if (isset($cart[$request->id])) {
        unset($cart[$request->id]);

        session()->put('cart', $cart);
        Session::flash('success', 'Berhasil menghapus product');
      }
    }
  }

  public function cekout()
  {
    $cart = session()->get('cart');
    $data = Data::paginate(10);

    $this->item['chart'] = $cart;
    $this->item['data'] = $data;

    $merek = Merek::all();

    return view('user.cekout', compact('merek'));
  }

  public function proses_cekout(Request $request, $id)
  {
    $user = User::findorfail($id);

    $user_data = [
      'address' => $request->address,
      'kelurahan' => $request->kelurahan,
      'kabupaten' => $request->kabupaten,
      'kecamatan' => $request->kecamatan,
      'provinsi' => $request->provinsi,
      'kode_pos' => $request->kode_pos,
      'telepon' => $request->telepon,
    ];

    $user->update($user_data);

    $cart = session()->get('cart');

    foreach ($cart as $details) {
      Order::create([
        'user_id' => $id,
        'data_id' => $details['data_id'],
        'quantity' => $details['quantity'],
        'total' => $details['price'] * $details['quantity'],
        'payment_status' => 'Belum Dibayar',
      ]);
    }

    $request->session()->forget('cart');

    $order = Order::orderBy('created_at', 'DESC')->where('user_id', $id)->first();

    return redirect()->route('pembayaran', $order->id)->with('success', 'Pembelian Berhasil Silahkan Melakukan Pembayaran Melalui Payment Yang Anda Pilih');
  }

  public function category($id)
  {
    $judul = Merek::findorfail($id);
    $data = Data::orderBy('created_at', 'DESC')->where('merek_id', $id)->paginate(12);
    $new = Data::orderBy('created_at', 'DESC')->first();
    $merek = Merek::all();

    return view('user.category', compact('judul', 'data', 'new', 'merek'));
  }

  public function like($id)
  {
    Favorite::create([
      'user_id' => Auth::user()->id,
      'data_id' => $id,
    ]);

    return redirect()->back()->with('success', 'Product added to favorite successfully!');
  }

  public function unlike($id)
  {
    $like = Favorite::where('user_id', Auth::user()->id)->where('data_id', $id)->first();
    $like->delete();

    return redirect()->back()->with('success', 'Product cancel to favorite successfully!');
  }

  public function favorite()
  {
    $like = Favorite::where('user_id', Auth::user()->id)->get();
    $new = Data::orderBy('created_at', 'DESC')->first();
    $merek = Merek::all();

    return view('user.favorite', compact('like', 'new', 'merek'));
  }

  public function delete($id)
  {
    $data = \App\data::find($id);
    $data->delete($data);
    return redirect()->back()->with('success', 'Product cancel to favorite successfully!');
  }
}
