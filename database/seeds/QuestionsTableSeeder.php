<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
    		1 => [
                'How do I change my password?',
                'How do I sign up?',
                'Can I remove a post?',
                'How do reviews work?'
            ],
    		2 => [
                'How does syncing work?',
                'How do I upload files from my phone or tablet?',
                'How do I link to a file or folder?'
            ],
    		3 => [
                'How do I change my password?',
                'How do I delete my account?',
                'How do I change my account settings?',
                'I forgot my password. How do I reset it?'
            ],
    		4 => [
                'Can I have an invoice for my subscription?',
                'Why did my credit card or PayPal payment fail?',
                'Why does my bank statement show multiple charges for one upgrade?'
            ],
    		5 => [
                'Can I specify my own private key?',
                'My files are missing! How do I get them back?',
                'How can I access my account data?',
                'How can I control if other search engines can link to my profile?'
            ],
    		6 => [
                'What should I do if my order hasn\'t been delivered yet?',
                'How can I find your international delivery information?',
                'Who takes care of shipping?',
                'How do returns or refunds work?',
                'How do I use shipping profiles?',
                'How does your UK Next Day Delivery service work?',
                'How does your Next Day Delivery service work?',
                'When will my order arrive?',
                'When will my order ship?'
            ],
    	];

    	foreach($data as $cat_id => $questions) {
    		foreach($questions as $question) {
		        DB::table('questions')->insert([
		            'category_id' => $cat_id,
		            'question' => $question,
                    'answer' => file_get_contents('http://loripsum.net/api'),
		            'user_email' => str_random(10) . '@gmail.com',
		            'user_name' => str_random(10),
		            'status_id' => 2,
		        ]);
    		}
    	}
    }
}
