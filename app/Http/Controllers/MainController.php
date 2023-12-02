<?php

namespace App\Http\Controllers;

use App\Classes\Sms;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Tags;
use App\Models\Classes;
use App\Models\Download;
use App\Models\Sale;
use App\Models\View;
use Flasher\Prime\FlasherInterface;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Str;

class MainController extends Controller
{
    public function auth ()
    {
        return view ('auth.auth');
    }

    // view file details
    public function viewFile ($slug)
    {
        $file       = Resource::where('slug', $slug)->first();
        $classes    = Classes::get();
        $subjects   = Subject::get();
        $tags       = Tags::get();
        $resources  = Resource::paginate(10);
        $downloads  = Download::where('resource_id', $file->id)->get();
        $views      = View::where('resource_id', $file->id)->first();

        // check if downloads record exists
        if (!empty($downloads)) {
            $downloads = $downloads->count();
        } else {
            $downloads = 0;
        }

        // check if view record exists
        if (!empty($views)) {
            $views = $views->count;
        } else {
            $views = 0;
        }

        // add record to views table
        // check if file is recorded already in the views table
        $checkView = View::where('resource_id', $file->id)->first();

        if(!empty($checkView)) {
            View::find($checkView->id)->update([
                'count' => $checkView->count + 1
            ]);
        } else {
            View::create([
                'resource_id'   => $file->id,
                'count'         => '1'
            ]);
        }

        return view ('pages.view-file', compact(
            'resources',
            'classes',
            'tags',
            'subjects',
            'file',
            'downloads',
            'views'
        ));
    }

    public function downloadFile ($slug, FlasherInterface $flasherInterface) {
        $item = Resource::where('slug', $slug)->first();
        $file = $item->file;

        if (Storage::disk('public')->exists($file)) {

            Download::create([
                'resource_id'   => $item->id,
                'count'         => '1'
            ]);
            // $checkDownload = Download::where('resource_id', $item->id)->first();

            // if(!empty($checkDownload)) {
            //     Download::find($checkDownload->id)->update([
            //         'count' => $checkDownload->count + 1
            //     ]);
            // } else {
            //     Download::create([
            //         'resource_id'   => $item->id,
            //         'count'         => '1'
            //     ]);
            // }

            return Storage::download('public/files/'.$file);
        } else {
            $flasherInterface->addError('File not found, try again');
            return redirect()->back();
        }
    }

    public function allResources($keyword, $slug)
    {
        $classes    = Classes::get();
        $subjects   = Subject::get();
        $tags       = Tags::get();

        $resources = [];
        $title = '';
        // retrieving per parameter passed
        // subject

        if ($keyword == 'subjects') {
            $subject    = Subject::where('slug', $slug)->first();
            $resources  = Resource::where('subject_id', $subject->id)->paginate(10);
            $title      = $subject->title;
        } elseif ($keyword == 'class'){
            $class      = Classes::where('slug', $slug)->first();
            $resources  = Resource::where('class_id', $class->id)->paginate(10);
            $title      = $class->class;
        } elseif ($keyword == 'tag'){
            $tag        = Tags::where('slug', $slug)->first();
            $resources  = Resource::where('tag_id', $tag->id)->paginate(10);
            $title      = $tag->tag;
        } elseif($keyword == 'curriculum') {
            $resources  = Resource::where('curriculum', $slug)->paginate(10);
            $title      = Str::ucfirst($slug . ' Curriculum');
        } else{
            $resources  = Resource::orderby('created_at', 'desc')->paginate(10);
            $title      = 'All Resources';
        }


        return view ('pages.all', compact(
            'classes',
            'tags',
            'subjects',
            'resources',
            'keyword',
            'title',
            'slug'
        ));
    }

    public function searchResource(Request $request)
    {
        $classes    = Classes::get();
        $subjects   = Subject::get();
        $tags       = Tags::get();

        $classFilter     = Classes::paginate(1);
        $subjectFilter   = Subject::get();
        $tagFilter       = Tags::get();

        $keyword = $request->keyword;
        $subject = $request->subject;
        $class   = $request->class;

        $data = Resource::orderby('created_at', 'desc');

        if( $request->keyword){
            $data = $data->orWhere('title', 'LIKE', "%" . $request->keyword . "%");
        }
        if( $request->subject){
            $data = $data->orWhere('subject_id', 'LIKE', "%" . $request->subject . "%");
        }
        if( $request->class ){
            $data = $data->orWhere('class_id', 'LIKE', "%" . $request->class . "%");
        }

        $resources = $data->paginate(10);

        return view ('pages.search', compact(
            'classes',
            'tags',
            'subjects',
            'keyword',
            'resources'
        ));

    }

    // purchase file using easypay api
    public function purchaseFile (Request $request, FlasherInterface $flasherInterface)
    {
        $this->validate($request, [
            'phone' => 'required|max:13'
        ]);

        $phone = $request->phone;
        // get resource details
        // $resource = Resource::find($request->resource);

        // // send sms
        // $username = "mbbaraka";
        // $password = "23April,1996";
        // $sender = "Barakhub";
        // $number = $phone;
        // $message = "You have successfully purchased ". $resource->title. ". Use this secret code: ". rand(1000,9999) ." to download your file.";
        // $sms = new Sms();
        // return $sms->SendSMS($username, $password, $sender, $number, $message);

        // return redirect()->back();


        $url = 'https://www.easypay.co.ug/api/';
         $payload = array( 'username' => 'b29cc9e7ec1a5173',
         'password' => '1f5cc6a1189088ce',
         'action' => 'mmdeposit',
         'amount' => $request->amount,
         'phone'=>$phone,
         'currency'=>'UGX',
         'reference'=>random_int(10000, 99999),
         'reason'=>'Testing MM DEPOSIT'
         );

         //open connection
         $ch = curl_init();

         //set the url, number of POST vars, POST data
         curl_setopt($ch,CURLOPT_URL, $url);
         curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($payload));
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,15);
         curl_setopt($ch, CURLOPT_TIMEOUT, 400); //timeout in seconds
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         //execute post
         $result = curl_exec($ch);

         //close connection
        //  curl_close($ch);

        if ($result) {
            // close connection
            curl_close($ch);
            // get resource details
            $resource = Resource::find($request->resource);

            // send sms
            $username = "mbbaraka";
            $password = "23April,1996";
            $sender = "Barakhub";
            $number = $phone;
            $code = rand(1000,9999);
            $token = sha1(rand());
            $message = "You have successfully purchased ". $resource->title. ". Use this secret code: ". $code ." to download your file.";
            $sms = new Sms();
            $sms->SendSMS($username, $password, $sender, $number, $message);

            // insert code into database
            Sale::create([
                'code'          =>  $code,
                'phone'         =>  $phone,
                'resource_id'   =>  $resource->id,
                'token'         =>  $token,
                'downloads'     =>  '0'
            ]);

            return redirect()->route('after-purchase', [$resource->slug, $token]);

        } else {
            $flasherInterface->addError('An error occured! Payment could not be processed!');
            return redirect()->back();
        }

    }

    public function afterPurchase($slug) {
        $file       = Resource::where('slug', $slug)->first();
        $classes    = Classes::get();
        $subjects   = Subject::get();
        $tags       = Tags::get();
        $resources  = Resource::paginate(10);
        $downloads  = Download::where('resource_id', $file->id)->get();
        $views      = View::where('resource_id', $file->id)->first();

        // check if downloads record exists
        if (!empty($downloads)) {
            $downloads = $downloads->count();
        } else {
            $downloads = 0;
        }

        // check if view record exists
        if (!empty($views)) {
            $views = $views->count;
        } else {
            $views = 0;
        }

        // add record to views table
        // check if file is recorded already in the views table
        $checkView = View::where('resource_id', $file->id)->first();

        if(!empty($checkView)) {
            View::find($checkView->id)->update([
                'count' => $checkView->count + 1
            ]);
        } else {
            View::create([
                'resource_id'   => $file->id,
                'count'         => '1'
            ]);
        }

        return view ('pages.download', compact(
            'resources',
            'classes',
            'tags',
            'subjects',
            'file',
            'downloads',
            'views'
        ));
    }

    public function openContactPage ()
    {
        return view('pages.contact');
    }

    public function openAboutPage ()
    {
        return view('pages.about');
    }

    public function verifyCode (Request $request, FlasherInterface $flasherInterface) {
        $this->validate($request, [
            'code' => 'required|min:4|max:6'
        ]);

        // check the code if it is true
        $code = $request->code;

        $resource = Sale::where('code', $code);

        if($resource->exists()) {
            //check number of downloads(a file is supposed to be downloaded only 2 times)
            if($resource->first()->downloads < 2){
                //proceed to check if file id exists
                if(Resource::find($resource->first()->resource_id)->exists()) {
                    //download the file
                    Sale::find($resource->first()->id)->update(['downloads' => $resource->first()->downloads+1]); //add 1 to downloads

                    $flasherInterface->addSuccess('File downloaded successfully!');
                    return redirect()->route('download-file', Resource::find($resource->first()->resource_id)->slug);

                } else {
                    $flasherInterface->addError('It seems the file no longer exists! COntact the administator!');
                    return redirect()->back();
                }
            } else {
                $flasherInterface->addError('You can only download any file twice!');
                return redirect()->back();
            }
        } else {
            $flasherInterface->addError('Incorrect code. Please try again!');
            return redirect()->back();
        }
    }

}
