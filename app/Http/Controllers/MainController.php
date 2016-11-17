<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\Repositories\Contracts\CategoryInterface;
use App\Zabor\Services\RedirectService;

use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;

class MainController extends Controller
{

    public function __construct(
        ItemInterface $item,
        CategoryInterface $category,
        RedirectService $redirector
    ) {
    
        $this->item         = $item;
        $this->category     = $category;
        $this->redirector   = $redirector;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!empty($request->page)) {
            return redirect($this->redirector->redirect($request->all()));
        }
        $items = $this->item->getLast();

        $item_count = $this->item->countActive();

        $categories = $this->category->getRootCategories();

        return view('main', compact(
            'items',
            'categories',
            'item_count'
        ));
    }

    public function testCrawler()
    {
        $client = new Client();
        $id = 269306;

       /* try{*/
            $res = $client->request('GET', "http://www.cars.kg/offers/{$id}.html", ['stream' => true]);
            $html = $res->getBody();
            $crawler = new Crawler($html->getContents());

            $data['title'] = strip_tags(trim(preg_replace('/\t+/', '', $crawler->filterXPath('//h1/text()')->text())));
            $data['description'] = strip_tags($crawler->filter('._cars_offer_full')->text());
            dd($data);
    /*    } catch(\Exception $e) {
            echo 'page does not exist';
        }*/
    }
}
