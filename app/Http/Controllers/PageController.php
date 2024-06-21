<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PageController extends Controller
{
    public function getPages()
    {
        $newestConference = Conference::orderBy('start_date', 'desc')->first();

        if (!$newestConference) {
            return response()->json(['error' => 'No conference found.']);
        }

        $pages = $newestConference->pages;

        return response()->json($pages);
    }

    public function getPage($id)
    {
        $page = Page::findOrFail($id);
        return response()->json($page);
    }

    public function createPage(Request $request)
    {
        $page = new Page;
        $page->title = $request->title;
        $page->content = $request->page_content;
        $page->save();

        $newestConference = Conference::orderBy('start_date', 'desc')->first();

        if (!$newestConference) {
            return response()->json(['error' => 'No conference found.']);
        }

        $newestConference->pages()->attach($page->id);

        return response()->json([
            'message' => 'Page created successfully',
            'page_id' => $page->id,
            'conference_id' => $newestConference->id,
        ]);
    }
}
