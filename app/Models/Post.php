<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post{

    public $title;

    public $excerpt;
    public $date;

    public $slog;

    public $body;

    public function __construct($title, $excerpt,$date,$body, $slog){
        $this->title=$title;

        $this->excerpt= $excerpt;
        $this->date= $date;

        $this->slog= $slog;

        $this->body= $body;

    }

    public static function all(){
      return cache()->rememberForever('posts.all',function(){
        return collect(File::files(resource_path("/posts/")))
        ->map(fn($file)=> YamlFrontMatter::parseFile($file))
            ->map(fn($document)=>new Post(
                $document->title,
                $document->excerpt,
                $document->data,
                $document->body(),
                $document->slug
            ))->sortByDesc('date');
           
      });
     
     }


    public static function find($slug){
        return static::all()->firstWhere('slog',$slug);
    }

    public static function findorfail($slug){
        $post=static::find($slug);
        if(!$post)
          throw new ModelNotFoundException();

       return $post;
    }
}