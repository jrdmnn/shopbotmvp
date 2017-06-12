<?php

namespace App\Conversations;

use Illuminate\Support\Facades\DB;
use Mpociot\BotMan\Conversation;
use App\Listing;

class ShowListConversation extends Conversation
{
    protected $emojiHelper;

    public function __construct() {
        $this->emojiHelper = resolve('App\Common\EmojiHelper');
    }

    public function getListing()
    {
        $listingId = Listing::first()->id;
        $items = DB::table('items')->where('listing_id', $listingId)->get();
        $sorted = $this->sortItems($items);
        $this->displayList($sorted);
    }

    protected function sortItems($items)
    {
        $ids = [4, 8, 12, 2, 6, 1, 3, 10, 9, 11, 5, 7];

        $sorted = $items->sortBy(function($model) use ($ids) {
            return array_search($model->category_id, $ids);
        });

        return $sorted;
    }

    protected function displayList($items)
    {
        $list = 'Hier ist deine Liste:' . "\n\n" . $this->emojiHelper->display(['list']) . "\n\n";
        foreach ($items as $item) {
            $list .= $item->name . "\n";
        }

        $this->say($list);
    }

    public function run()
    {
       $this->getListing();
    }
}
