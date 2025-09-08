<?php

namespace Database\Seeders;

use App\Models\Books;
use App\Models\Categories;
use App\Models\Locations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 5 Buku Sastra
        $sastra = [
            [
                'title'            => 'Layar Terkembang',
                'author'           => 'Sutan Takdir Alisjahbana',
                'publisher'        => 'Balai Pustaka',
                'date_publication' => '1936-01-01',
                'description'      => 'Novel sastra klasik Indonesia tentang modernitas dan tradisi.',
                'stock'            => 5,
            ],
            [
                'title'            => 'Belenggu',
                'author'           => 'Armijn Pane',
                'publisher'        => 'Balai Pustaka',
                'date_publication' => '1940-01-01',
                'description'      => 'Novel psikologis dengan gaya modernis.',
                'stock'            => 4,
            ],
            [
                'title'            => 'Sitti Nurbaya',
                'author'           => 'Marah Rusli',
                'publisher'        => 'Balai Pustaka',
                'date_publication' => '1922-01-01',
                'description'      => 'Kisah cinta tragis dan kritik adat.',
                'stock'            => 6,
            ],
            [
                'title'            => 'Burung-Burung Manyar',
                'author'           => 'Y.B. Mangunwijaya',
                'publisher'        => 'Djambatan',
                'date_publication' => '1981-01-01',
                'description'      => 'Novel sastra tentang cinta, perang, dan kemanusiaan.',
                'stock'            => 7,
            ],
            [
                'title'            => 'Cantik Itu Luka',
                'author'           => 'Eka Kurniawan',
                'publisher'        => 'Gramedia',
                'date_publication' => '2002-01-01',
                'description'      => 'Novel realisme magis tentang cinta, kolonialisme, dan tragedi.',
                'stock'            => 8,
            ],
        ];

        foreach ($sastra as $book) {
            Books::create(array_merge($book, [
                'category_id' => 9,
                'location_id' => 1,
            ]));
        }

        // 5 Buku Fiksi
        $fiksi = [
            [
                'title'            => 'Harry Potter and the Philosopher\'s Stone',
                'author'           => 'J.K. Rowling',
                'publisher'        => 'Bloomsbury',
                'date_publication' => '1997-06-26',
                'description'      => 'Awal kisah penyihir muda Harry Potter.',
                'stock'            => 12,
            ],
            [
                'title'            => 'The Hobbit',
                'author'           => 'J.R.R. Tolkien',
                'publisher'        => 'George Allen & Unwin',
                'date_publication' => '1937-09-21',
                'description'      => 'Petualangan Bilbo Baggins sebelum The Lord of the Rings.',
                'stock'            => 9,
            ],
            [
                'title'            => 'To Kill a Mockingbird',
                'author'           => 'Harper Lee',
                'publisher'        => 'J.B. Lippincott & Co.',
                'date_publication' => '1960-07-11',
                'description'      => 'Novel fiksi dengan tema keadilan sosial.',
                'stock'            => 10,
            ],
            [
                'title'            => '1984',
                'author'           => 'George Orwell',
                'publisher'        => 'Secker & Warburg',
                'date_publication' => '1949-06-08',
                'description'      => 'Novel distopia tentang totalitarianisme.',
                'stock'            => 11,
            ],
            [
                'title'            => 'The Great Gatsby',
                'author'           => 'F. Scott Fitzgerald',
                'publisher'        => 'Charles Scribner\'s Sons',
                'date_publication' => '1925-04-10',
                'description'      => 'Novel klasik Amerika tentang mimpi dan tragedi.',
                'stock'            => 6,
            ],
        ];

        foreach ($fiksi as $book) {
            Books::create(array_merge($book, [
                'category_id' => 1,
                'location_id' => 2,
            ]));
        }

        // 5 Buku Non Fiksi
        $nonFiksi = [
            [
                'title'            => 'Sapiens: A Brief History of Humankind',
                'author'           => 'Yuval Noah Harari',
                'publisher'        => 'Harper',
                'date_publication' => '2014-02-10',
                'description'      => 'Sejarah evolusi manusia dari Homo sapiens hingga modern.',
                'stock'            => 10,
            ],
            [
                'title'            => 'Educated',
                'author'           => 'Tara Westover',
                'publisher'        => 'Random House',
                'date_publication' => '2018-02-20',
                'description'      => 'Memoar perjuangan pendidikan dari keluarga fundamentalis.',
                'stock'            => 7,
            ],
            [
                'title'            => 'Thinking, Fast and Slow',
                'author'           => 'Daniel Kahneman',
                'publisher'        => 'Farrar, Straus and Giroux',
                'date_publication' => '2011-10-25',
                'description'      => 'Buku psikologi tentang dua sistem berpikir manusia.',
                'stock'            => 8,
            ],
            [
                'title'            => 'The Selfish Gene',
                'author'           => 'Richard Dawkins',
                'publisher'        => 'Oxford University Press',
                'date_publication' => '1976-03-13',
                'description'      => 'Konsep gen egois dalam evolusi biologi.',
                'stock'            => 5,
            ],
            [
                'title'            => 'The Power of Habit',
                'author'           => 'Charles Duhigg',
                'publisher'        => 'Random House',
                'date_publication' => '2012-02-28',
                'description'      => 'Bagaimana kebiasaan terbentuk dan cara mengubahnya.',
                'stock'            => 9,
            ],
        ];

        foreach ($nonFiksi as $book) {
            Books::create(array_merge($book, [
                'category_id' => 2,
                'location_id' => 3,
            ]));
        }
    }
}
