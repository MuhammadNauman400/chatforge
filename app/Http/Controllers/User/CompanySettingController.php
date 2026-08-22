<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CompanySettingController extends Controller
{
    public function CompanySetting()
    {
        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->back('error', 'You are not associated with a company');
        }

        return view('client.website.company_setting', compact('company'));
    }

    public function CompanySettingUpdate(Request $request)
    {

        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->back()->with('error', 'You are not associated with a company');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:companies,name,' . $company->id,
            'company_logo' => 'nullable'
        ]);

        if ($request->file('company_logo')) {
            $image = $request->file('company_logo');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(867, 1000)->save(public_path('upload/slider/' . $name_gen));
            $save_url = 'upload/slider/' . $name_gen;

            if (file_exists(public_path($company->company_logo))) {
                @unlink(public_path($company->company_logo));
            }
            $company->company_logo = $save_url;
        }

        $selectedChatbotId = $request->input('chatbot_embed_code');
        $chatbotEmbedCode = null;

        if ($selectedChatbotId) {

            $selectedChatbot = $company->chatbots()->find($selectedChatbotId);
            if ($selectedChatbot) {
                $chatbotEmbedCode = '<div id="my-chatbot-widget" data-chatbot-id=" ' . $selectedChatbot->id . ' "></div>';
                $chatbotEmbedCode .= '<script src=" ' . asset('js/chatbot-widget.js') . '"></script>';
            }
        }

        $company->name = $request->name;
        $company->slug = Str::slug($request->name);
        $company->header_content = $request->header_content;
        $company->about_us_content = $request->about_us_content;
        $company->services_content = $request->services_content;
        $company->contact_info = $request->contact_info;
        $company->social_email = $request->social_email;
        $company->social_phone = $request->social_phone;
        $company->chatbot_embed_code = $chatbotEmbedCode;

        $company->save();

        $notification = array(
            'message' => 'Website Setting Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //End Method
}
