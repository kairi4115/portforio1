<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\RecipeStep;
use Thujohn\Twitter\Twitter;
use Abraham\TwitterOAuth\TwitterOAuth;

class  TwitterController extends Controller
{
    public function tweetProduct($id)
    {
        // 商品情報を取得
        $product = Product::find($id);
        
        if (!$product) {
            abort(404);
        }
    
        // Twitter投稿に使用する情報
        $status = "Check out this product: {$product->name} - {$product->description} Price: {$product->price} 円 + 税";
        $media = asset('images') . '/' . $product->image; // 画像のURL
        dd($media);
        // Twitter APIへのアクセス
        $twitter = new TwitterOAuth(config('services.twitter.consumer_key'), config('services.twitter.consumer_secret'), config('services.twitter.access_token'), config('services.twitter.access_token_secret'));

        // 画像をアップロード
        $media_upload = $twitter->upload('media/upload', ['media' => $media]);
       
        // 投稿に画像を添付
        $parameters = [
            'status' => $status,
            'media_ids' => implode(',', [$media_upload->media_id_string]),
        ];

        // 投稿実行
        $result = $twitter->post('statuses/update', $parameters);

        return redirect()->back()->with('success', 'Product tweeted successfully');

    }

}
