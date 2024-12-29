<?php

namespace App\Http\Controllers;

use App\Models\ArticleNews;
use App\Models\Author;
use App\Models\BannerAds;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $articles = ArticleNews::with('category')
        ->where('is_featured', 'not_featured')
        ->latest()
        ->take(3)
        ->get();

        $latest_articles = ArticleNews::with('category')
        ->latest()
        ->take(3)
        ->get();
    
        $featured_articles = ArticleNews::with('category')
        ->where('is_featured', 'featured')
        ->inRandomOrder()
        ->take(3)
        ->get();

        $authors = Author::all();

        $bannerads = BannerAds::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        // ->take(1)
        ->first();

        $entertainment_articles = ArticleNews::whereHas('category', function($query){
            $query->where('name', 'Entertainment');
        })
        ->where('is_featured', 'not_featured')
        ->latest()
        ->take(5)
        ->get();

        $entertainment_featured_articles = ArticleNews::whereHas('category', function($query){
            $query->where('name', 'Entertainment');
        })
        ->where('is_featured', 'featured')
        ->inRandomOrder()
        ->get()
        ->first();

        $business_articles = ArticleNews::whereHas('category', function($query){
            $query->where('name', 'Business');
        })
        ->where('is_featured', 'not_featured')
        ->latest()
        ->take(5)
        ->get();

        $business_featured_articles = ArticleNews::whereHas('category', function($query){
            $query->where('name', 'Business');
        })
        ->where('is_featured', 'featured')
        ->inRandomOrder()
        ->get()
        ->first();

        $automotive_articles = ArticleNews::whereHas('category', function($query){
            $query->where('name', 'Automotive');
        })
        ->where('is_featured', 'not_featured')
        ->latest()
        ->take(5)
        ->get();

        $automotive_featured_articles = ArticleNews::whereHas('category', function($query){
            $query->where('name', 'Automotive');
        })
        ->where('is_featured', 'featured')
        ->inRandomOrder()
        ->get()
        ->first();

        return view('front.index', compact('latest_articles','automotive_articles', 'automotive_featured_articles', 'business_articles', 'business_featured_articles', 'entertainment_featured_articles', 'entertainment_articles', 'categories', 'articles', 'authors', 'featured_articles', 'bannerads'));
    }

    public function category(Category $category){
        $categories = Category::all();

        $bannerads = BannerAds::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        // ->take(1)
        ->first();

        return view('front.category', compact('category', 'categories', 'bannerads'));
    }

    public function author(Author $author){
        $categories = Category::all();

        $bannerads = BannerAds::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        // ->take(1)
        ->first();

        return view('front.author', compact('author' , 'categories', 'bannerads'));
    }

    public function search(Request $request) {
        $request->validate([
            'keyword' => ['required', 'string', 'max:255'],
        ]);

        $categories = Category::all();

        $keyword = $request->keyword;

        $articles = ArticleNews::with('category', 'author')
        ->where('name', 'like', "%" . $keyword . "%")->paginate(6);

        return view('front.search', compact('keyword', 'categories', 'articles'));
    }

    public function details(ArticleNews $articleNews) {
        $categories = Category::all();

        $articles = ArticleNews::with('category')
        ->where('is_featured', 'not_featured')
        ->where('id', '!=', $articleNews->id)
        ->latest()
        ->take(3)
        ->get();

        $bannerads = BannerAds::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        // ->take(1)
        ->first();

        $squareads = BannerAds::where('type', 'square')
        ->where('is_active', 'active')
        ->inRandomOrder()
        ->take(2)
        ->get();

        if($squareads->count() < 2){
            $squareads1 = $squareads->first();
            $squareads2 = null;
        } else {
            $squareads1 = $squareads->get(0);
            $squareads2 = $squareads->get(1);
        }

        $author_news = ArticleNews::where('author_id', $articleNews->author_id)
        ->where('id', '!=', $articleNews->id)
        ->inRandomOrder()->get();

        return view('front.details', compact('articleNews' , 'categories', 'articles', 'bannerads', 'squareads', 'squareads1', 'squareads2' , 'author_news'));
    }
}
