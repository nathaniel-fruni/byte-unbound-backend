<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PageController extends Controller
{
    private $newestConference;

    public function __construct()
    {
        $this->newestConference = fetchNewestConference();
    }

    public function getPages()
    {
        if (!$this->newestConference) {
            return response()->json(['error' => 'No conference found.']);
        }

        $pages = $this->newestConference->pages;

        return response()->json($pages);
    }

    public function getPage($id)
    {
        $page = Page::findOrFail($id);
        return response()->json($page);
    }

    public function createPage(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'page_content' => 'required|string',
        ]);

        $page = new Page;
        $page->title = $request->title;
        $page->content = $request->page_content;
        $page->save();

        $this->newestConference->pages()->attach($page->id);

        return response()->json([
            'message' => 'Page created successfully',
            'page_id' => $page->id,
            'conference_id' => $this->newestConference->id,
        ]);
    }
}
