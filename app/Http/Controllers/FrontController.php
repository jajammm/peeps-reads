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

        return view('front.index', compact('automotive_articles', 'automotive_featured_articles', 'business_articles', 'business_featured_articles', 'entertainment_featured_articles', 'entertainment_articles', 'categories', 'articles', 'authors', 'featured_articles', 'bannerads'));
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
}
