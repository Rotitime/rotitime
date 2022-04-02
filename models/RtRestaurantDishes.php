<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rt_restaurant_dishes".
 *
 * @property int $dish_id
 * @property int $restaurant_id
 * @property string $dish_name
 * @property string $dish_category
 * @property string $is_dish_halal
 * @property string $dish_allergy_text
 * @property int $dish_number_in_menu
 * @property float $dish_price
 * @property float $dish_discount_price
 * @property int $dish_discount_percentage
 * @property string $dish_image
 * @property string $dish_image_alt_text_english
 * @property string $dish_image_alt_text_german
 * @property string $dish_image_title_text_english
 * @property string $dish_image_title_text_german
 * @property string $dish_type
 * @property string $dish_link
 * @property string $dish_info_english
 * @property string $dish_info_german
 * @property string $is_delivery_availabe
 * @property string $is_dish_active
 * @property int $dish_added_by
 * @property string $dish_added_at
 */
class RtRestaurantDishes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rt_restaurant_dishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'dish_number_in_menu', 'dish_discount_percentage', 'dish_added_by'], 'integer'],
            [['is_dish_halal', 'is_delivery_availabe', 'is_dish_active'], 'string'],
            [['dish_price', 'dish_discount_price'], 'number'],
            [['dish_added_at'], 'safe'],
            [['dish_name'], 'string', 'max' => 155],
            [['dish_category'], 'string', 'max' => 225],
            [['dish_allergy_text', 'dish_image', 'dish_image_alt_text_english', 'dish_image_alt_text_german', 'dish_image_title_text_english', 'dish_image_title_text_german'], 'string', 'max' => 200],
            [['dish_type', 'dish_link'], 'string', 'max' => 60],
            [['dish_info_english', 'dish_info_german'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dish_id' => 'Dish ID',
            'restaurant_id' => 'Restaurant ID',
            'dish_name' => 'Dish Name',
            'dish_category' => 'Dish Category',
            'is_dish_halal' => 'Is Dish Halal',
            'dish_allergy_text' => 'Dish Allergy Text',
            'dish_number_in_menu' => 'Dish Number In Menu',
            'dish_price' => 'Dish Price',
            'dish_discount_price' => 'Dish Discount Price',
            'dish_discount_percentage' => 'Dish Discount Percentage',
            'dish_image' => 'Dish Image',
            'dish_image_alt_text_english' => 'Dish Image Alt Text English',
            'dish_image_alt_text_german' => 'Dish Image Alt Text German',
            'dish_image_title_text_english' => 'Dish Image Title Text English',
            'dish_image_title_text_german' => 'Dish Image Title Text German',
            'dish_type' => 'Dish Type',
            'dish_link' => 'Dish Link',
            'dish_info_english' => 'Dish Info English',
            'dish_info_german' => 'Dish Info German',
            'is_delivery_availabe' => 'Is Delivery Availabe',
            'is_dish_active' => 'Is Dish Active',
            'dish_added_by' => 'Dish Added By',
            'dish_added_at' => 'Dish Added At',
        ];
    }
}
