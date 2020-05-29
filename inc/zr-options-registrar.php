<?php
class ZR_Options_Registrar extends ZR_Registrar 
{
    public function register() {
        $this->register_centers(); 
        $this->register_fees();
        $this->register_default_role();
    }

    private function register_fees() {
        $data = [
            'general_fees' => [
                'application' => '0.00',
                'pegging' => '0.00',
                'allocation' => '0.00',
                'lease_application' => '0.00',
                'lease_processing' => '0.00',
                'lease_site_plan' => '0.00'
            ],
            'lease_deposit' => [
                'res_lo' => '0.00',
                'res_mid' => '0.00',
                'red_hi' => '0.00',
                'non_com' => '0.00',
                'non_ind' => '0.00',
                'non_ins' => '0.00'
            ]
        ];

        update_option( 'fees', $data );
    }

    private function register_centers() {
        $data = [
            'zhombe' => 'Zhombe District Service Center',
            'silobela' => 'Silobela District Service Center',
            'redcliff' => 'Redcliff District Service Center',
            'zibagwe_chirumanzu' => 'Zibagwe-Chirimanzu District Service Center'
        ];

        update_option( 'centers', $data );
    }

    private function register_default_role() {
        update_option( 'default_role', 'zr_client' ); 
    }

    public static function instance() {
        return new self();
    }
}
?>