<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_users')->only('index');
        $this->middleware('can:edit_user')->only(['edit','update']);
        $this->middleware('can:edit_create')->only(['create','store']);
        $this->middleware('can:delete_user')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query();

       if (Gate::allows('show_management')){
           if (request('search') != 'website-management-users') {
               $users->where([
                   ['is_staff', '!=', '1'],
                   ['is_superuser', '!=', '1'],
               ]);
           }
           if (request('search') == 'website-management-users') {
               $users->where('is_superuser', 1)
                   ->orWhere('is_staff', 1);
           }
       }else{
           $users->where([
               ['is_staff', '!=', '1'],
               ['is_superuser', '!=', '1'],
           ]);
       }
        if ($search = \request('search') and request('search') != 'website-management-users') {
            $users->where([
                    ['email', 'LIKE', "%{$search}%"],
                    ['is_staff', '!=', '1'],
                    ['is_superuser', '!=', '1'],
                ]
            )
                ->orWhere([
                    ['name', 'LIKE', "%{$search}%"],
                    ['is_staff', '!=', '1'],
                    ['is_superuser', '!=', '1'],
                ])
                ->orWhere([
                    ['id', $search],
                    ['is_staff', '!=', '1'],
                    ['is_superuser', '!=', '1'],
                ]);
        }

        $users = $users->simplePaginate(10);

        return view('admin.users.all', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        if ($request->has('verify')) {
            $user->markEmailAsVerified();
        }
        alert()->success("کاربر {$request->name} با موفقیت ساخته شد", 'عملیات موفق')->persistent('بسیارخوب');
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'max:255', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        if (!is_null($request->input('password'))) {
            $request->validate([
                'password' => 'required|string|confirmed|min:8',
            ]);
            $data['password'] = bcrypt($request->input('password'));
        }
        $user->update($data);
        alert()->success('کاربر مورد نظر با موفقیت ویرایش شد.', 'عملیات موفق');
        return redirect(route('admin.users.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        alert()->warning('کاربر مورد نظر با موفقیت حذف گردید', 'عملیات موفق');
        return back();
    }
}
