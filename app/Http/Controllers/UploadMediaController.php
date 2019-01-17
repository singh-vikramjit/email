<?php

namespace App\Http\Controllers;

use Redirect;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Aws\Credentials\Credentials;
use Aws\S3\Exception\S3Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Filesystem\Filesystem;


class UploadMediaController extends Controller
{	

	public function everything_in_tags($string, $tagname)
	{
		$pattern = "/<$tagname>(.*?)<\/$tagname>/";
    	preg_match($pattern, $string, $matches);

	    return $matches[1] ?? false;
	}

   	public function uploadFile(Request $request)
	{	
		$error = [];
		$url = '';
		$preview = false;

		if ($request->isMethod('post')) {

			$validator =  Validator::make($request->all(), [
			    'folder' => 'alpha_dash'
			]);

			if ($validator->fails()) {
			    return Redirect::back()->withErrors($validator)->withInput();
			}

			$image = $request->file('media');

			//$imageFileName = rand() . '_' . $image->getClientOriginalName();
			$imageFileName = $image->getClientOriginalName();

			$imageExtensions = ['jpg','jpeg','png','svg','bmp','gif','tiff']; 

			if(in_array( strtolower($image->getClientOriginalExtension()) ,$imageExtensions)){
				$preview = true;
			}

			$credentials = new Credentials($request->access_key,$request->secret_key);
		    
		    $s3 = new S3Client([
		           'region' => $request->region,
		           'version' => 'latest',
		           'credentials' => $credentials
		       ]);

			$filePath = $imageFileName;
		    
		    if($request->folder){
		    	$filePath = $request->folder.'/'.$imageFileName;
		    }

			try {

				$res = $s3->putObject(array(
				    'Bucket'     => $request->bucket,
				    'Key'        => $filePath,
				    'ACL'    	 => 'public-read-write',
				    'SourceFile' => $image->getPathName(),
				    'ContentType' => $image->getMimeType(),
				));

				$url = $res['ObjectURL'];

			} catch (S3Exception $e) {
				
				$error_msg = $e->getMessage();

				$errorCode = $this->everything_in_tags($error_msg,'Code') ?? '';
				$errormsg = $this->everything_in_tags($error_msg,'Message');

				switch ($errorCode) {
					case "SignatureDoesNotMatch":
						$error['secret_key'] = $errormsg;
						break;
					case "NoSuchBucket":
						$error['bucket'] = $errormsg;
						break;
					case "InvalidAccessKeyId":
						$error['access_key'] = $errormsg;
						break;
					case "AccessDenied":
						$error['error'] = $errormsg;
						break;
					default:
						$error['error'] = $error_msg;
						break;
				}

				return Redirect::back()->withErrors($error)->withInput();
			}
		}
		return view('UploadFile',[ 'url' => $url , 'preview' => $preview ]);
	}
}