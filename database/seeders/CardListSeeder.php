<?php

namespace Database\Seeders;

use App\Models\Cards;
use Illuminate\Database\Seeder;

class CardListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 1;
        $card->card_title = "Twilio integration";
        $card->card_text = "Create new note via SMS. Support text, audio, links, and media.";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 2;
        $card->card_title = "Markdown support";
        $card->card_text = "Markdown shorthand converts to formatting";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 1;
        $card->card_title = "Tablet view";
        $card->card_text = "Tablet view";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 2;
        $card->card_title = "Audio recording in note";
        $card->card_text = "Show audio in a note and playback UI";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 3;
        $card->card_title = "Bookmark in note";
        $card->card_text = "Show rich link UI in a note, and feature to render website screenshot.";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 4;
        $card->card_title = "Image viewer";
        $card->card_text = "Opens when clicking on the thumbnail in the list or on the image in the note";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 1;
        $card->card_title = "Mobile view";
        $card->card_text = "Functions for both web responsive and native apps. Note: Android and iOS will need unique share icons.";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 2;
        $card->card_title = "Desktop view";
        $card->card_text = "PWA for website and native apps. Note: Windows and Mac will need unique share icons.";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 3;
        $card->card_title = "Formatting options";
        $card->card_text = "Mobile formatting bar expands and collapses when tapping the format icon.";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 4;
        $card->card_title = "Media in note";
        $card->card_text = "Image & video with player UI";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 1;
        $card->card_title = "Audio recording";
        $card->card_text = "Interface for when recording a new audio note";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 2;
        $card->card_title = "Bookmarking";
        $card->card_text = "Interface for when creating a new link note.";
        $card->save();

        $card = new Cards();
        $card->list_id = 1;
        $card->card_row = 3;
        $card->card_title = "Interface for when creating a new link note.";
        $card->card_text = "Folders, tags, and notes lists are sorted by recent.";
        $card->save();
    }
}
