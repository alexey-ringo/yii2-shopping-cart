<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image_product`.
 */
class m180718_090434_create_image_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%image_product}}', [
            'id' => $this->primaryKey(11),
            'product_id' => $this->integer()->notNull()->unsigned(),
            //'product_code' => $this->integer(11)->notNull()->unique()->unsigned(),
            'img1' => $this->string(255)->defaultValue('no-image.png'),
            'img2' => $this->string(255)->defaultValue('no-image.png'),
            'img3' => $this->string(255)->defaultValue('no-image.png'),
            'img4' => $this->string(255)->defaultValue('no-image.png'),
            'img5' => $this->string(255)->defaultValue('no-image.png'),
            'img6' => $this->string(255)->defaultValue('no-image.png'),
        ]);
        
        //$this->addForeignKey('fk-image-product', '{{%image_product}}', 'product_code', '{{%product}}', 'code', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-image-product', '{{%image_product}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        
        $this->batchInsert('{{%image_product}}',
                    ['product_id', 'img1', 'img2', 'img3', 'img4', 'img5', 'img6'],
                    [
                        [/*1041000*/1, '10410001.jpg', '10410002.jpg', '10410003.jpg', '10410004.jpg', '10410005.jpg', '10410006.jpg'],
                        [/*1041002*/2, '10410021.jpg', '10410022.jpg', '10410023.jpg', '10410024.jpg', '10410025.jpg', '10410026.jpg'],
                        [/*1041003*/3, '10410031.jpg', '10410032.jpg', '10410033.jpg', '10410034.jpg', '10410035.jpg', '10410036.jpg'],
                        [/*041004*/4, '10410041.jpg', '10410042.jpg', '10410043.jpg', '10410044.jpg', '10410045.jpg', '10410046.jpg'],
                        [/*1041005*/5, '10410051.jpg', '10410052.jpg', '10410053.jpg', '10410054.jpg', '10410055.jpg', '10410056.jpg'],
                        [/*1041006*/6, '10410061.jpg', '10410062.jpg', '10410063.jpg', '10410064.jpg', '10410065.jpg', '10410066.jpg'],
                        [/*1041007*/7, '10410071.jpg', '10410072.jpg', '10410073.jpg', '10410074.jpg', '10410075.jpg', '10410076.jpg'],
                        [/*1041008*/8, '10410081.jpg', '10410082.jpg', '10410083.jpg', '10410084.jpg', '10410085.jpg', '10410086.jpg'],
                        [/*1041009*/9, '10410091.jpg', '10410092.jpg', '10410093.jpg', '10410094.jpg', '10410095.jpg', '10410096.jpg'],
                        [/*1041010*/10, '10410101.jpg', '10410102.jpg', '10410103.jpg', '10410104.jpg', '10410105.jpg', '10410106.jpg'],
                        [/*1041011*/11, '10410111.jpg', '10410112.jpg', '10410113.jpg', '10410114.jpg', '10410115.jpg', '10410116.jpg'],
                        
                        [/*1061000*/12, '10610001.jpg', '10610002.jpg', '10610003.jpg', '10610004.jpg', '10610005.jpg', '10610006.jpg'],
                        [/*1061002*/13, '10610021.jpg', '10610022.jpg', '10610023.jpg', '10610024.jpg', '10610025.jpg', '10610026.jpg'],
                        [/*1061003*/14, '10610031.jpg', '10610032.jpg', '10610033.jpg', '10610034.jpg', '10610035.jpg', '10610036.jpg'],
                        [/*1061004*/15, '10610041.jpg', '10610042.jpg', '10610043.jpg', '10610044.jpg', '10610045.jpg', '10610046.jpg'],
                        [/*1061005*/16, '10610051.jpg', '10610052.jpg', '10610053.jpg', '10610054.jpg', '10610055.jpg', '10610056.jpg'],
                        
                        [/*1091000*/17, '10910001.jpg', '10910002.jpg', '10910003.jpg', '10910004.jpg', '10910005.jpg', '10910006.jpg'],
                        [/*1091002*/18, '10910021.jpg', '10910022.jpg', '10910023.jpg', '10910024.jpg', '10910025.jpg', '10910026.jpg'],
                        [/*1091003*/19, '10910031.jpg', '10910032.jpg', '10910033.jpg', '10910034.jpg', '10910035.jpg', '10910036.jpg'],
                        [/*1091004*/20, '10910041.jpg', '10910042.jpg', '10910043.jpg', '10910044.jpg', '10910045.jpg', '10910046.jpg'],
                        [/*1091005*/21, '10910051.jpg', '10910052.jpg', '10910053.jpg', '10910054.jpg', '10910055.jpg', '10910056.jpg'],
                        [/*1091006*/22, '10910061.jpg', '10910062.jpg', '10910063.jpg', '10910064.jpg', '10910065.jpg', '10910066.jpg'],
                        [/*1091007*/23, '10910071.jpg', '10910072.jpg', '10910073.jpg', '10910074.jpg', '10910075.jpg', '10910076.jpg'],
                        
                        [/*1121000*/24, '11210001.jpg', '11210002.jpg', '11210003.jpg', '11210004.jpg', '11210005.jpg', '11210006.jpg'],
                        [/*1121002*/25, '11210021.jpg', '11210022.jpg', '11210023.jpg', '11210024.jpg', '11210025.jpg', '11210026.jpg'],
                        [/*1121003*/26, '11210031.jpg', '11210032.jpg', '11210033.jpg', '11210034.jpg', '11210035.jpg', '11210036.jpg'],
                        [/*1121004*/27, '11210041.jpg', '11210042.jpg', '11210043.jpg', '11210044.jpg', '11210045.jpg', '11210046.jpg'],
                        
                    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%image_product}}');
        $this->dropTable('{{%image_product}}');
    }
}
