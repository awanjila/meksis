<?php

namespace Database\Seeders;

use App\Models\BackOffice\Faq;
use App\Models\BackOffice\FaqSetting;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        FaqSetting::firstOrCreate(['id' => 1], [
            'title' => 'FREQUENTLY ASKED QUESTIONS',
            'subtitle' => 'Answers to the questions we hear most',
        ]);

        $faqs = [
            [
                'question' => 'What types of water tanks does Meksis Engineering supply?',
                'answer' => "We supply elevated pressed steel tanks, galvanized steel tanks, GRP water tanks, ground level tanks, and rooftop tanks, along with steel towers and tank accessories.",
            ],
            [
                'question' => 'Do you install tanks outside Nairobi?',
                'answer' => "Yes. We install and maintain tanks for residential, commercial, and industrial clients across Kenya and the wider East Africa region.",
            ],
            [
                'question' => 'What is the difference between a pressed steel tank and a GRP tank?',
                'answer' => "Pressed steel tanks are fabricated from steel panels and can be elevated or installed at ground level. GRP tanks are lightweight, corrosion-resistant composite tanks suited to both residential and commercial use.",
            ],
            [
                'question' => 'Do you offer tank maintenance?',
                'answer' => "Yes. We provide tank maintenance services in addition to supply and installation. Contact us with details of your existing tank and we will advise on the best approach.",
            ],
            [
                'question' => 'How do I get a quote or site visit?',
                'answer' => "Send us a message through the contact page, call +254 735 551515, or email info@meksis.co.ke. Tell us your tank type, capacity, and site location so we can prepare an accurate quote.",
            ],
            [
                'question' => 'Can you fabricate custom steel structures?',
                'answer' => "Yes. Alongside water tanks we carry out general steel fabrication and custom tank fabrication for commercial and industrial requirements.",
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::firstOrCreate(
                ['question' => $faq['question']],
                [
                    'answer' => $faq['answer'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
