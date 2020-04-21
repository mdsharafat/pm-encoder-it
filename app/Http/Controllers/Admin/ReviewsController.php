<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

use App\Employee;
use App\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $reviews = Review::where('emp_id', 'LIKE', "%$keyword%")
                ->orWhere('reviewed_by', 'LIKE', "%$keyword%")
                ->orWhere('note', 'LIKE', "%$keyword%")
                ->orWhere('point', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $reviews = Review::latest()->paginate($perPage);
        }

        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        $employees = Employee::all();
        $review    = new Review();
        return view('admin.reviews.create', compact('employees', 'review'));
    }

    public function store(Request $request)
    {
        $review              = new Review();
        $review->emp_id      = $request->emp_id;
        $review->point       = $request->point;
        $review->note        = $request->note;
        $review->reviewed_by = Auth::user()->id;
        $review->save();
        return redirect('reviews')->with('flashMessage', 'Review added!');
    }

    public function show($id)
    {
        $review = Review::findOrFail($id);
        return view('admin.reviews.show', compact('review'));
    }

    public function edit($id)
    {
        $employees = Employee::all();
        $review    = Review::findOrFail($id);

        return view('admin.reviews.edit', compact('employees', 'review'));
    }

    public function update(Request $request, $id)
    {
        $review                     = Review::findOrFail($id);
        $requestData                = array();
        $requestData['point']       = $request->point;
        $requestData['note']        = $request->note;
        $requestData['reviewed_by'] = Auth::user()->id;
        $review->update($requestData);
        return redirect('reviews')->with('flashMessage', 'Review updated!');
    }

    public function destroy($id)
    {
        Review::destroy($id);

        return redirect('reviews')->with('flashMessage', 'Review deleted!');
    }
}
