<?php

namespace Fintech\Card\Seeders;

use Fintech\Business\Facades\Business;
use Fintech\Core\Facades\Core;
use Fintech\MetaData\Facades\MetaData;
use Illuminate\Database\Seeder;

class WalletToPrepaidCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Core::packageExists('Business')) {

            $parent = Business::serviceType()->list(['service_type_slug' => 'withdraw'])->first();

            $servingCountries = MetaData::country()->servingIds();

            Business::serviceTypeManager($this->data(), $parent)
                ->srcCountries($servingCountries)
                ->distCountries($servingCountries)
                ->hasService()
                ->hasTransactionForm()
                ->execute();
        }
    }

    private function data(): array
    {
        $image_svg = base_path('vendor/fintech/reload/resources/img/service_type/logo_svg/');
        $image_png = base_path('vendor/fintech/reload/resources/img/service_type/logo_png/');

        return [
            'service_type_name' => 'Wallet To Prepaid Card',
            'service_type_slug' => 'wallet_to_prepaid_card',
            'logo_svg' => "{$image_svg}wallet_to_prepaid_card.svg",
            'logo_png' => "{$image_png}wallet_to_prepaid_card.png",
            'service_type_is_parent' => 'no',
            'service_type_is_description' => 'no',

        ];
    }
}
