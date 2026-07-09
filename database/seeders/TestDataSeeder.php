<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Filter;
use App\Models\FilterOption;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Clean existing data
        \DB::statement('DELETE FROM filter_option_product');
        \DB::statement('DELETE FROM product_images');
        \DB::statement('DELETE FROM products');
        \DB::statement('DELETE FROM filter_options');
        \DB::statement('DELETE FROM category_filters');
        \DB::statement('DELETE FROM filters');
        \DB::statement('DELETE FROM brands');
        \DB::statement('DELETE FROM categories');
        \DB::statement('DELETE FROM sqlite_sequence');

        // =============================================
        // CATEGORIES
        // =============================================
        $catSmartphones = Category::create([
            'name' => ['az' => 'Smartfonlar', 'en' => 'Smartphones', 'ru' => 'Смартфоны'],
            'info' => ['az' => 'Ən yeni smartfonlar', 'en' => 'Latest smartphones', 'ru' => 'Новейшие смартфоны'],
            'status' => true, 'is_featured' => true,
        ]);
        $catLaptops = Category::create([
            'name' => ['az' => 'Noutbuklar', 'en' => 'Laptops', 'ru' => 'Ноутбуки'],
            'info' => ['az' => 'Oyun və iş noutbukları', 'en' => 'Gaming and business laptops', 'ru' => 'Игровые и рабочие ноутбуки'],
            'status' => true, 'is_featured' => true,
        ]);
        $catAccessories = Category::create([
            'name' => ['az' => 'Aksesuarlar', 'en' => 'Accessories', 'ru' => 'Аксессуары'],
            'info' => ['az' => 'Qulaqlıq, kabel və daha çoxu', 'en' => 'Headphones, cables and more', 'ru' => 'Наушники, кабели и другое'],
            'status' => true, 'is_featured' => true,
        ]);

        // =============================================
        // FILTERS — SMARTPHONES (6 filter)
        // =============================================
        $spStorage = Filter::create(['name' => ['az' => 'Yaddaş', 'en' => 'Storage', 'ru' => 'Память']]);
        $spStorage->categories()->attach($catSmartphones);
        $spStorage64  = FilterOption::create(['filter_id' => $spStorage->id, 'value' => ['az' => '64 GB', 'en' => '64 GB', 'ru' => '64 ГБ']]);
        $spStorage128 = FilterOption::create(['filter_id' => $spStorage->id, 'value' => ['az' => '128 GB', 'en' => '128 GB', 'ru' => '128 ГБ']]);
        $spStorage256 = FilterOption::create(['filter_id' => $spStorage->id, 'value' => ['az' => '256 GB', 'en' => '256 GB', 'ru' => '256 ГБ']]);
        $spStorage512 = FilterOption::create(['filter_id' => $spStorage->id, 'value' => ['az' => '512 GB', 'en' => '512 GB', 'ru' => '512 ГБ']]);

        $spColor = Filter::create(['name' => ['az' => 'Rəng', 'en' => 'Color', 'ru' => 'Цвет']]);
        $spColor->categories()->attach($catSmartphones);
        $spColorBlack  = FilterOption::create(['filter_id' => $spColor->id, 'value' => ['az' => 'Qara', 'en' => 'Black', 'ru' => 'Черный']]);
        $spColorWhite  = FilterOption::create(['filter_id' => $spColor->id, 'value' => ['az' => 'Ağ', 'en' => 'White', 'ru' => 'Белый']]);
        $spColorSilver = FilterOption::create(['filter_id' => $spColor->id, 'value' => ['az' => 'Gümüş', 'en' => 'Silver', 'ru' => 'Серебристый']]);
        $spColorGold   = FilterOption::create(['filter_id' => $spColor->id, 'value' => ['az' => 'Qızılı', 'en' => 'Gold', 'ru' => 'Золотой']]);

        $spRam = Filter::create(['name' => ['az' => 'RAM', 'en' => 'RAM', 'ru' => 'ОЗУ']]);
        $spRam->categories()->attach($catSmartphones);
        $spRam4 = FilterOption::create(['filter_id' => $spRam->id, 'value' => ['az' => '4 GB', 'en' => '4 GB', 'ru' => '4 ГБ']]);
        $spRam6 = FilterOption::create(['filter_id' => $spRam->id, 'value' => ['az' => '6 GB', 'en' => '6 GB', 'ru' => '6 ГБ']]);
        $spRam8 = FilterOption::create(['filter_id' => $spRam->id, 'value' => ['az' => '8 GB', 'en' => '8 GB', 'ru' => '8 ГБ']]);
        $spRam12 = FilterOption::create(['filter_id' => $spRam->id, 'value' => ['az' => '12 GB', 'en' => '12 GB', 'ru' => '12 ГБ']]);

        $spScreen = Filter::create(['name' => ['az' => 'Ekran ölçüsü', 'en' => 'Screen size', 'ru' => 'Размер экрана']]);
        $spScreen->categories()->attach($catSmartphones);
        $spScreen61 = FilterOption::create(['filter_id' => $spScreen->id, 'value' => ['az' => '6.1"', 'en' => '6.1"', 'ru' => '6.1"']]);
        $spScreen67 = FilterOption::create(['filter_id' => $spScreen->id, 'value' => ['az' => '6.7"', 'en' => '6.7"', 'ru' => '6.7"']]);
        $spScreen63 = FilterOption::create(['filter_id' => $spScreen->id, 'value' => ['az' => '6.3"', 'en' => '6.3"', 'ru' => '6.3"']]);

        $spBattery = Filter::create(['name' => ['az' => 'Batareya tutumu', 'en' => 'Battery capacity', 'ru' => 'Емкость аккумулятора']]);
        $spBattery->categories()->attach($catSmartphones);
        $spBatt4000 = FilterOption::create(['filter_id' => $spBattery->id, 'value' => ['az' => '4000 mAh', 'en' => '4000 mAh', 'ru' => '4000 мАч']]);
        $spBatt4500 = FilterOption::create(['filter_id' => $spBattery->id, 'value' => ['az' => '4500 mAh', 'en' => '4500 mAh', 'ru' => '4500 мАч']]);
        $spBatt5000 = FilterOption::create(['filter_id' => $spBattery->id, 'value' => ['az' => '5000 mAh', 'en' => '5000 mAh', 'ru' => '5000 мАч']]);

        $spCamera = Filter::create(['name' => ['az' => 'Kamera', 'en' => 'Camera', 'ru' => 'Камера']]);
        $spCamera->categories()->attach($catSmartphones);
        $spCam48 = FilterOption::create(['filter_id' => $spCamera->id, 'value' => ['az' => '48 MP', 'en' => '48 MP', 'ru' => '48 Мп']]);
        $spCam50 = FilterOption::create(['filter_id' => $spCamera->id, 'value' => ['az' => '50 MP', 'en' => '50 MP', 'ru' => '50 Мп']]);
        $spCam108 = FilterOption::create(['filter_id' => $spCamera->id, 'value' => ['az' => '108 MP', 'en' => '108 MP', 'ru' => '108 Мп']]);
        $spCam200 = FilterOption::create(['filter_id' => $spCamera->id, 'value' => ['az' => '200 MP', 'en' => '200 MP', 'ru' => '200 Мп']]);

        // =============================================
        // FILTERS — LAPTOPS (6 filter)
        // =============================================
        $lpProcessor = Filter::create(['name' => ['az' => 'Prosessor', 'en' => 'Processor', 'ru' => 'Процессор']]);
        $lpProcessor->categories()->attach($catLaptops);
        $lpProcI5 = FilterOption::create(['filter_id' => $lpProcessor->id, 'value' => ['az' => 'Intel i5', 'en' => 'Intel i5', 'ru' => 'Intel i5']]);
        $lpProcI7 = FilterOption::create(['filter_id' => $lpProcessor->id, 'value' => ['az' => 'Intel i7', 'en' => 'Intel i7', 'ru' => 'Intel i7']]);
        $lpProcI9 = FilterOption::create(['filter_id' => $lpProcessor->id, 'value' => ['az' => 'Intel i9', 'en' => 'Intel i9', 'ru' => 'Intel i9']]);
        $lpProcR5 = FilterOption::create(['filter_id' => $lpProcessor->id, 'value' => ['az' => 'AMD Ryzen 5', 'en' => 'AMD Ryzen 5', 'ru' => 'AMD Ryzen 5']]);
        $lpProcR7 = FilterOption::create(['filter_id' => $lpProcessor->id, 'value' => ['az' => 'AMD Ryzen 7', 'en' => 'AMD Ryzen 7', 'ru' => 'AMD Ryzen 7']]);

        $lpScreen = Filter::create(['name' => ['az' => 'Ekran ölçüsü', 'en' => 'Screen size', 'ru' => 'Размер экрана']]);
        $lpScreen->categories()->attach($catLaptops);
        $lpScreen13 = FilterOption::create(['filter_id' => $lpScreen->id, 'value' => ['az' => '13.3"', 'en' => '13.3"', 'ru' => '13.3"']]);
        $lpScreen14 = FilterOption::create(['filter_id' => $lpScreen->id, 'value' => ['az' => '14"', 'en' => '14"', 'ru' => '14"']]);
        $lpScreen15 = FilterOption::create(['filter_id' => $lpScreen->id, 'value' => ['az' => '15.6"', 'en' => '15.6"', 'ru' => '15.6"']]);
        $lpScreen17 = FilterOption::create(['filter_id' => $lpScreen->id, 'value' => ['az' => '17.3"', 'en' => '17.3"', 'ru' => '17.3"']]);

        $lpRam = Filter::create(['name' => ['az' => 'RAM', 'en' => 'RAM', 'ru' => 'ОЗУ']]);
        $lpRam->categories()->attach($catLaptops);
        $lpRam8  = FilterOption::create(['filter_id' => $lpRam->id, 'value' => ['az' => '8 GB', 'en' => '8 GB', 'ru' => '8 ГБ']]);
        $lpRam16 = FilterOption::create(['filter_id' => $lpRam->id, 'value' => ['az' => '16 GB', 'en' => '16 GB', 'ru' => '16 ГБ']]);
        $lpRam32 = FilterOption::create(['filter_id' => $lpRam->id, 'value' => ['az' => '32 GB', 'en' => '32 GB', 'ru' => '32 ГБ']]);
        $lpRam64 = FilterOption::create(['filter_id' => $lpRam->id, 'value' => ['az' => '64 GB', 'en' => '64 GB', 'ru' => '64 ГБ']]);

        $lpStorage = Filter::create(['name' => ['az' => 'Yaddaş növü', 'en' => 'Storage type', 'ru' => 'Тип накопителя']]);
        $lpStorage->categories()->attach($catLaptops);
        $lpStorageSSD256  = FilterOption::create(['filter_id' => $lpStorage->id, 'value' => ['az' => '256 GB SSD', 'en' => '256 GB SSD', 'ru' => '256 ГБ SSD']]);
        $lpStorageSSD512  = FilterOption::create(['filter_id' => $lpStorage->id, 'value' => ['az' => '512 GB SSD', 'en' => '512 GB SSD', 'ru' => '512 ГБ SSD']]);
        $lpStorageSSD1TB  = FilterOption::create(['filter_id' => $lpStorage->id, 'value' => ['az' => '1 TB SSD', 'en' => '1 TB SSD', 'ru' => '1 ТБ SSD']]);
        $lpStorageSSD2TB  = FilterOption::create(['filter_id' => $lpStorage->id, 'value' => ['az' => '2 TB SSD', 'en' => '2 TB SSD', 'ru' => '2 ТБ SSD']]);

        $lpGpu = Filter::create(['name' => ['az' => 'Ekran kartı', 'en' => 'Graphics card', 'ru' => 'Видеокарта']]);
        $lpGpu->categories()->attach($catLaptops);
        $lpGpuIntel  = FilterOption::create(['filter_id' => $lpGpu->id, 'value' => ['az' => 'Intel UHD Graphics', 'en' => 'Intel UHD Graphics', 'ru' => 'Intel UHD Graphics']]);
        $lpGpuRTX3050 = FilterOption::create(['filter_id' => $lpGpu->id, 'value' => ['az' => 'NVIDIA RTX 3050', 'en' => 'NVIDIA RTX 3050', 'ru' => 'NVIDIA RTX 3050']]);
        $lpGpuRTX4060 = FilterOption::create(['filter_id' => $lpGpu->id, 'value' => ['az' => 'NVIDIA RTX 4060', 'en' => 'NVIDIA RTX 4060', 'ru' => 'NVIDIA RTX 4060']]);
        $lpGpuRTX4070 = FilterOption::create(['filter_id' => $lpGpu->id, 'value' => ['az' => 'NVIDIA RTX 4070', 'en' => 'NVIDIA RTX 4070', 'ru' => 'NVIDIA RTX 4070']]);

        $lpWeight = Filter::create(['name' => ['az' => 'Çəki', 'en' => 'Weight', 'ru' => 'Вес']]);
        $lpWeight->categories()->attach($catLaptops);
        $lpWeight12 = FilterOption::create(['filter_id' => $lpWeight->id, 'value' => ['az' => '1.2 kq', 'en' => '1.2 kg', 'ru' => '1.2 кг']]);
        $lpWeight14 = FilterOption::create(['filter_id' => $lpWeight->id, 'value' => ['az' => '1.4 kq', 'en' => '1.4 kg', 'ru' => '1.4 кг']]);
        $lpWeight16 = FilterOption::create(['filter_id' => $lpWeight->id, 'value' => ['az' => '1.6 kq', 'en' => '1.6 kg', 'ru' => '1.6 кг']]);
        $lpWeight19 = FilterOption::create(['filter_id' => $lpWeight->id, 'value' => ['az' => '1.9 kq', 'en' => '1.9 kg', 'ru' => '1.9 кг']]);
        $lpWeight25 = FilterOption::create(['filter_id' => $lpWeight->id, 'value' => ['az' => '2.5 kq', 'en' => '2.5 kg', 'ru' => '2.5 кг']]);

        // =============================================
        // FILTERS — ACCESSORIES (4 filter)
        // =============================================
        $acType = Filter::create(['name' => ['az' => 'Növ', 'en' => 'Type', 'ru' => 'Тип']]);
        $acType->categories()->attach($catAccessories);
        $acTypeHeadphones = FilterOption::create(['filter_id' => $acType->id, 'value' => ['az' => 'Qulaqlıq', 'en' => 'Headphones', 'ru' => 'Наушники']]);
        $acTypeCable      = FilterOption::create(['filter_id' => $acType->id, 'value' => ['az' => 'Kabel', 'en' => 'Cable', 'ru' => 'Кабель']]);
        $acTypePowerbank  = FilterOption::create(['filter_id' => $acType->id, 'value' => ['az' => 'Enerji bankı', 'en' => 'Power bank', 'ru' => 'Повербанк']]);
        $acTypeMouse      = FilterOption::create(['filter_id' => $acType->id, 'value' => ['az' => 'Siçan', 'en' => 'Mouse', 'ru' => 'Мышь']]);

        $acConnection = Filter::create(['name' => ['az' => 'Bağlantı növü', 'en' => 'Connection type', 'ru' => 'Тип подключения']]);
        $acConnection->categories()->attach($catAccessories);
        $acConnWireless = FilterOption::create(['filter_id' => $acConnection->id, 'value' => ['az' => 'Simsiz', 'en' => 'Wireless', 'ru' => 'Беспроводной']]);
        $acConnWired    = FilterOption::create(['filter_id' => $acConnection->id, 'value' => ['az' => 'Simli', 'en' => 'Wired', 'ru' => 'Проводной']]);
        $acConnUSB      = FilterOption::create(['filter_id' => $acConnection->id, 'value' => ['az' => 'USB-C', 'en' => 'USB-C', 'ru' => 'USB-C']]);

        $acColor = Filter::create(['name' => ['az' => 'Rəng', 'en' => 'Color', 'ru' => 'Цвет']]);
        $acColor->categories()->attach($catAccessories);
        $acColorBlack  = FilterOption::create(['filter_id' => $acColor->id, 'value' => ['az' => 'Qara', 'en' => 'Black', 'ru' => 'Черный']]);
        $acColorWhite  = FilterOption::create(['filter_id' => $acColor->id, 'value' => ['az' => 'Ağ', 'en' => 'White', 'ru' => 'Белый']]);
        $acColorBlue   = FilterOption::create(['filter_id' => $acColor->id, 'value' => ['az' => 'Mavi', 'en' => 'Blue', 'ru' => 'Синий']]);

        $acBattery = Filter::create(['name' => ['az' => 'Batareya', 'en' => 'Battery', 'ru' => 'Батарея']]);
        $acBattery->categories()->attach($catAccessories);
        $acBattNo     = FilterOption::create(['filter_id' => $acBattery->id, 'value' => ['az' => 'Yoxdur', 'en' => 'None', 'ru' => 'Нет']]);
        $acBatt5000   = FilterOption::create(['filter_id' => $acBattery->id, 'value' => ['az' => '5000 mAh', 'en' => '5000 mAh', 'ru' => '5000 мАч']]);
        $acBatt10000  = FilterOption::create(['filter_id' => $acBattery->id, 'value' => ['az' => '10000 mAh', 'en' => '10000 mAh', 'ru' => '10000 мАч']]);
        $acBatt20000  = FilterOption::create(['filter_id' => $acBattery->id, 'value' => ['az' => '20000 mAh', 'en' => '20000 mAh', 'ru' => '20000 мАч']]);

        // =============================================
        // BRANDS
        // =============================================
        $bSamsung = Brand::create(['name' => 'Samsung']);
        $bApple   = Brand::create(['name' => 'Apple']);
        $bXiaomi  = Brand::create(['name' => 'Xiaomi']);
        $bHP      = Brand::create(['name' => 'HP']);
        $bLenovo  = Brand::create(['name' => 'Lenovo']);
        $bAsus    = Brand::create(['name' => 'Asus']);
        $bJBL     = Brand::create(['name' => 'JBL']);
        $bAnker   = Brand::create(['name' => 'Anker']);
        $bLogitech = Brand::create(['name' => 'Logitech']);

        // =============================================
        // PRODUCTS
        // =============================================
        $makeProduct = function ($name, $catId, $brandId, $price, array $filterOptionIds = []) {
            $product = Product::create([
                'slug'   => Str::slug($name['en'] ?? $name['az']),
                'name'   => $name,
                'short_description' => [
                    'az' => $name['az'] . ' - ən yaxşı seçim',
                    'en' => $name['en'] . ' - the best choice',
                    'ru' => $name['ru'] . ' - лучший выбор',
                ],
                'description' => [
                    'az' => $name['az'] . ' haqqında ətraflı məlumat. Yüksək keyfiyyət, əlverişli qiymət.',
                    'en' => 'Detailed information about ' . $name['en'] . '. High quality, affordable price.',
                    'ru' => 'Подробная информация о ' . $name['ru'] . '. Высокое качество, доступная цена.',
                ],
                'price'     => $price,
                'category_id' => $catId,
                'brand_id'  => $brandId,
                'view_count' => rand(50, 500),
                'status'    => true,
            ]);
            if (!empty($filterOptionIds)) {
                $product->filterOptions()->attach($filterOptionIds);
            }
        };

        // ----- Smartphones (5+ filter per product) -----
        $makeProduct(
            ['az' => 'Samsung Galaxy S25 Ultra', 'en' => 'Samsung Galaxy S25 Ultra', 'ru' => 'Samsung Galaxy S25 Ultra'],
            $catSmartphones->id, $bSamsung->id, 2999,
            [$spStorage256->id, $spColorBlack->id, $spRam12->id, $spScreen63->id, $spBatt5000->id, $spCam200->id]
        );
        $makeProduct(
            ['az' => 'iPhone 16 Pro Max', 'en' => 'iPhone 16 Pro Max', 'ru' => 'iPhone 16 Pro Max'],
            $catSmartphones->id, $bApple->id, 3899,
            [$spStorage512->id, $spColorSilver->id, $spRam8->id, $spScreen67->id, $spBatt4500->id, $spCam48->id]
        );
        $makeProduct(
            ['az' => 'Xiaomi 14 Ultra', 'en' => 'Xiaomi 14 Ultra', 'ru' => 'Xiaomi 14 Ultra'],
            $catSmartphones->id, $bXiaomi->id, 1799,
            [$spStorage128->id, $spColorWhite->id, $spRam6->id, $spScreen61->id, $spBatt5000->id, $spCam50->id]
        );

        // ----- Laptops (5+ filter per product) -----
        $makeProduct(
            ['az' => 'HP Spectre x360', 'en' => 'HP Spectre x360', 'ru' => 'HP Spectre x360'],
            $catLaptops->id, $bHP->id, 3299,
            [$lpProcI7->id, $lpScreen15->id, $lpRam16->id, $lpStorageSSD512->id, $lpGpuIntel->id, $lpWeight16->id]
        );
        $makeProduct(
            ['az' => 'Lenovo ThinkPad X1 Carbon', 'en' => 'Lenovo ThinkPad X1 Carbon', 'ru' => 'Lenovo ThinkPad X1 Carbon'],
            $catLaptops->id, $bLenovo->id, 4199,
            [$lpProcI5->id, $lpScreen14->id, $lpRam8->id, $lpStorageSSD512->id, $lpGpuIntel->id, $lpWeight12->id]
        );
        $makeProduct(
            ['az' => 'Asus ROG Strix G16', 'en' => 'Asus ROG Strix G16', 'ru' => 'Asus ROG Strix G16'],
            $catLaptops->id, $bAsus->id, 4599,
            [$lpProcR7->id, $lpScreen17->id, $lpRam32->id, $lpStorageSSD1TB->id, $lpGpuRTX4070->id, $lpWeight25->id]
        );
        $makeProduct(
            ['az' => 'HP Pavilion 15', 'en' => 'HP Pavilion 15', 'ru' => 'HP Pavilion 15'],
            $catLaptops->id, $bHP->id, 2199,
            [$lpProcR5->id, $lpScreen15->id, $lpRam8->id, $lpStorageSSD256->id, $lpGpuRTX3050->id, $lpWeight19->id]
        );
        $makeProduct(
            ['az' => 'Asus ZenBook 14', 'en' => 'Asus ZenBook 14', 'ru' => 'Asus ZenBook 14'],
            $catLaptops->id, $bAsus->id, 2799,
            [$lpProcI5->id, $lpScreen14->id, $lpRam16->id, $lpStorageSSD512->id, $lpGpuIntel->id, $lpWeight14->id]
        );

        // ----- Accessories (3+ filter per product) -----
        $makeProduct(
            ['az' => 'JBL Tune 720BT', 'en' => 'JBL Tune 720BT', 'ru' => 'JBL Tune 720BT'],
            $catAccessories->id, $bJBL->id, 149,
            [$acTypeHeadphones->id, $acConnWireless->id, $acColorBlack->id, $acBattNo->id]
        );
        $makeProduct(
            ['az' => 'Anker Power Bank 20000mAh', 'en' => 'Anker Power Bank 20000mAh', 'ru' => 'Anker Power Bank 20000mAh'],
            $catAccessories->id, $bAnker->id, 89,
            [$acTypePowerbank->id, $acConnUSB->id, $acColorBlack->id, $acBatt20000->id]
        );
        $makeProduct(
            ['az' => 'JBL Quantum 100', 'en' => 'JBL Quantum 100', 'ru' => 'JBL Quantum 100'],
            $catAccessories->id, $bJBL->id, 79,
            [$acTypeHeadphones->id, $acConnWired->id, $acColorBlack->id, $acBattNo->id]
        );
        $makeProduct(
            ['az' => 'Logitech MX Master 3S', 'en' => 'Logitech MX Master 3S', 'ru' => 'Logitech MX Master 3S'],
            $catAccessories->id, $bLogitech->id, 129,
            [$acTypeMouse->id, $acConnWireless->id, $acColorBlack->id, $acBatt5000->id]
        );

        $this->command->info('Test data seeded successfully!');
    }
}
