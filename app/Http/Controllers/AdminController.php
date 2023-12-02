<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Download;
use App\Models\Resource;
use App\Models\Subject;
use App\Models\Tags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
        // total resources
        $totalResources = Resource::get()->count();
        // total downloads
        $totalDownloads = Download::get()->count();
        // total sales
        $totalSales = '6500';

        // $downloads = Download::pluck('count');
        // downlaods
        $dToday = Download::whereDay('created_at', '=', date('d'))->get()->count();

        // yestrday
        $dYesterday = Download::whereDate('created_at', '=', Carbon::now()->subdays(1))->get()->count();

        $dLastWeek      = Download::whereDate('created_at', '>', Carbon::today()->subdays(7))->get()->count();

        // last month
        $dLastMonth = Download::whereMonth('created_at', '=', date('m'))->get()->count();

        return view('admin.index', compact(
            'totalResources',
            'totalDownloads',
            'totalSales',
            'dYesterday',
            'dLastWeek',
            'dLastMonth',
            'dToday'
        ));
    }

    // subjects functions
    public function indexSubject ()
    {
        $subjects = Subject::paginate(5);
        return view ('admin.subject', compact('subjects'));
    }

    public function storeSubject (Request $request, FlasherInterface $flasherInterface)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        Subject::create([
            'title' => $request->title,
            'slug'  => Str::slug($request->title)
        ]);

        $flasherInterface->addSuccess('Subject has been added!');
        return redirect()->back();

    }

    public function viewSubject ()
    {

    }

    public function destroySubject (Request $request, FlasherInterface $flasherInterface)
    {
        $id = $request->id;
        Subject::find($id)->delete($id);
        $flasherInterface->addSuccess('Subject has been deleted!');
        return redirect()->back();
    }

    /**
     * classes functions
     *
     */
    public function indexClass ()
    {
        $classes = Classes::paginate(5);
        return view ('admin.class', compact('classes'));
    }

    public function storeClass (Request $request, FlasherInterface $flasherInterface)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        Classes::create([
            'class' => $request->title,
            'slug'  => Str::slug($request->title)
        ]);

        $flasherInterface->addSuccess('Class has been added!');
        return redirect()->back();

    }

    public function viewClass ()
    {

    }

    public function destroyClass (Request $request, FlasherInterface $flasherInterface)
    {
        $id = $request->id;
        Classes::find($id)->delete($id);
        $flasherInterface->addSuccess('Class has been deleted!');
        return redirect()->back();
    }


    /**
     * tags functions
     *
     */
    public function indexTag ()
    {
        $tags = Tags::paginate(5);
        return view ('admin.tag', compact('tags'));
    }

    public function storeTag (Request $request, FlasherInterface $flasherInterface)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        Tags::create([
            'tag'   => $request->title,
            'slug'  => Str::slug($request->title)
        ]);

        $flasherInterface->addSuccess('Tag has been added!');
        return redirect()->back();

    }

    public function viewTag ()
    {

    }

    public function destroyTag (Request $request, FlasherInterface $flasherInterface)
    {
        $id = $request->id;
        Tags::find($id)->delete($id);
        $flasherInterface->addSuccess('Tag has been deleted!');
        return redirect()->back();
    }



    /**
     * resources functions
     */
    public function indexResource ()
    {
        $classes    = Classes::get();
        $subjects   = Subject::get();
        $tags       = Tags::get();
        $resources  = Resource::paginate(10);
        return view ('admin.resources', compact('resources', 'classes', 'tags', 'subjects'));
    }

    public function storeResource (Request $request, FlasherInterface $flasherInterface)
    {
        $this->validate($request, [
            'title'     => 'required',
            'file'      => 'required|mimes:pdf,doc,docx,txt|max:20480',
            'class'     => 'required',
            'tag'       => 'required',
            'subject'   => 'required',
            'curriculum' => 'required'
        ]);

        $fileName = time().$request->file('file')->getClientOriginalName();

        $type = $request->file->extension();

        $size = $request->file->getSize();

        if(empty($request->price)) {
            $price = 0;
        } else {
            $price = $request->price;
        }

        $store = Resource::create([
                'title'         => $request->title,
                'slug'          => Str::slug($request->title),
                'price'         => $price,
                'user_id'       => Auth::user()->id,
                'class_id'      => $request->class,
                'tag_id'        => $request->tag,
                'subject_id'    => $request->subject,
                'file'          => $fileName,
                'type'          => $type,
                'size'          => $size,
                'description'   => $request->description,
                'curriculum'   => $request->curriculum
            ]);

        if($store){
            $request->file('file')->storeAs('public/files', $fileName);
        }

        $flasherInterface->addSuccess('Resource has been added!');
        return redirect()->back();

    }

    public function updateResource (Request $request, $id, FlasherInterface $flasherInterface)
    {
        // dd($request->all());
        $this->validate($request, [
            'title'     => 'required',
            'file'      => 'mimes:pdf,doc,docx,txt|max:20480',
            'class'     => 'required',
            'tag'       => 'required',
            'subject'   => 'required',
            'curriculum' => 'required'
        ]);

        if  ($request->file('file')) {
            $fileName = time().$request->file('file')->getClientOriginalName();

            $type = $request->file->extension();

            $size = $request->file->getSize();

            $request->file('file')->storeAs('public/files', $fileName);
        } else {
            $item = Resource::find($id);
            $fileName = $item->file;

            $type = $item->type;

            $size = $item->size;
        }

        Resource::find($id)->update([
                'title'         => $request->title,
                'slug'          => Str::slug($request->title),
                'price'         => $request->price,
                'user_id'       => Auth::user()->id,
                'class_id'      => $request->class,
                'tag_id'        => $request->tag,
                'subject_id'    => $request->subject,
                'file'          => $fileName,
                'type'          => $type,
                'size'          => $size,
                'description'   => $request->description,
                'curriculum'  => $request->curriculum
            ]);



        $flasherInterface->addSuccess('Resource has been updated!');
        return redirect()->back();

    }

    public function viewResource ()
    {

    }

    public function destroyResource (Request $request, FlasherInterface $flasherInterface)
    {
        $id = $request->id;
        $item = Resource::find($id);

        if(file_exists('public/files/' . $item->file)) {
            unlink('public/files/' . $item->file);
        }

        $item->views->delete();
        $item->downloads->delete();
        $item->delete();

        $flasherInterface->addSuccess('Tag has been deleted!');
        return redirect()->back();
    }

}
