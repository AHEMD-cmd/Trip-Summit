<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateCounterItemRequest;
use Illuminate\Http\Request;
use App\Models\CounterItem;

class CounterItemController extends Controller
{
    public function edit()
    {
        $counterItem = CounterItem::first();
        return view('admin.counter.edit', compact('counterItem'));
    }

    public function update(UpdateCounterItemRequest $request)
    {
        $counterItem = CounterItem::findOrFail(1);

        $counterItem->update($request->validated());

        return redirect()->back()->with('success', 'Counter Item Updated Successfully');
    }
}
