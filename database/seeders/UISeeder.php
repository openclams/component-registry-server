<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class UISeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        try { 
            
            $this->insert_data_types();
            
            $this->insert_menu_items();
            
            Permission::generateFor('components');

            Permission::generateFor('providers');

            Permission::generateFor('attributes');

            Permission::generateFor('edge_constraints');
            
            Permission::generateFor('edges');

            Permission::generateFor('categories');
            
            $role = Role::where('name', 'admin')->firstOrFail();

            $permissions = Permission::all();

            $role->permissions()->sync(
                $permissions->pluck('id')->all()
            );
            
        } catch (\Illuminate\Database\QueryException $ex) {
            
            dd($ex->getMessage());
            
        }
    }
    
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
    
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }
    
    public function insert_data_types()
    {

        // 0 `name`
        // 1 `slug`
        // 2 `display_name_singular`
        // 3 `display_name_plural`
        // 4 `icon` 
        // 5 `model_name
        // 6 `policy_name`
        // 7 `controller`
        // 8 `description`
        // 9 `generate_permissions`
        // 10 `server_side`
        // 11`details`
        // 12`created_at`
        // 13`updated_at`
        $types = [['components', 'components', 'Component', 'Components', NULL, 'App\\Models\\Component', NULL, '\\App\\Http\\Controllers\\Voyager\\ComponentController', NULL, 1, 1, "{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}", '2021-01-18 07:51:00', '2021-04-07 07:54:51'],
        ['providers', 'providers', 'Provider', 'Providers', NULL, 'App\\Models\\Provider', NULL, NULL, NULL, 1, 0, "{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}", '2021-01-18 09:37:08', '2021-01-18 09:37:08'],
        ['attributes', 'attributes', 'Attribute', 'Attributes', NULL, 'App\\Models\\Attribute', NULL, NULL, NULL, 1, 1, "{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"id_name\",\"scope\":null}", '2021-01-19 12:58:27', '2021-01-31 16:09:41'],
        ['edge_constraints', 'edge-constraints', 'Edge Constraint', 'Edge Constraints', NULL, 'App\\Models\\EdgeConstraint', NULL, NULL, NULL, 1, 0, "{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}", '2021-02-01 10:26:36', '2021-02-01 10:33:01'],
        ['edges', 'edges', 'Edge', 'Edges', NULL, 'App\\Models\\Edge', NULL, '\\App\\Http\\Controllers\\Voyager\\EdgeController', NULL, 1, 0, "{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}", '2021-02-01 10:47:02', '2021-02-02 12:36:03'],
        ['categories', 'categories', 'Category', 'Categories', NULL, 'App\\Models\\Category', NULL, NULL, NULL, 1, 0, "{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}", '2021-02-03 07:22:08', '2021-02-03 07:22:08']];
        
        foreach ($types as &$type) {
            $dataType = $this->dataType('slug', $type[1]);
            if (!$dataType->exists) {

                $dataType->fill([
                    'name'                  => $type[0],
                    'display_name_singular' => $type[2],
                    'display_name_plural'   => $type[3],
                    'icon'                  => $type[4],
                    'model_name'            => $type[5],
                    'policy_name'           => $type[6],
                    'controller'            => $type[7],
                    'generate_permissions'  => $type[9],
                    'description'           => $type[8],
                    'server_side'           => $type[10],
                    'details'               => json_decode($type[11], true),
                ])->save();
            }
            $this->insert_data_row($dataType);
        }  
    }
    
    
    public function insert_data_row($dataType)
    {
        
        $dataRows = [
        'components' => [
            ['id', 'text', 'Attributes', 1, 0, 1, 1, 0, 0, "{\"view\":\"attributes.formfields\"}", 1],
            ['name', 'text', 'Name', 1, 1, 1, 1, 1, 1, "{}", 4],
            ['img', 'media_picker', 'Image', 0, 1, 1, 1, 1, 1, "{\"max\":1,\"min\":0,\"expanded\":true,\"show_folders\":true,\"allow_upload\":true,\"allow_move\":true,\"allow_delete\":true,\"allow_rename\":true,\"allowed\":[],\"hide_thumbnails\":false,\"show_as_images\":true}", 3],
            ['provider_id', 'text', 'Provider Id', 1, 0, 0, 0, 0, 0, "{}", 2],
            ['component_belongsto_provider_relationship', 'relationship', 'Providers', 0, 1, 1, 1, 1, 1, "{\"model\":\"App\\\\Models\\\\Provider\",\"table\":\"providers\",\"type\":\"belongsTo\",\"column\":\"provider_id\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"attributes\",\"pivot\":\"0\",\"taggable\":\"0\"}", 5],
            ['isTemplate', 'checkbox', 'Type', 1, 1, 1, 1, 1, 1, "{\"on\":\"Is Template\",\"off\":\"Is Component\",\"checked\":false}", 5],
            ['component_belongsto_component_relationship', 'relationship', 'Parent', 0, 1, 1, 1, 1, 1, "{\"model\":\"App\\\\Models\\\\Component\",\"table\":\"components\",\"type\":\"belongsTo\",\"column\":\"parent_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"attributes\",\"pivot\":\"0\",\"taggable\":\"0\"}", 6],
            ['order', 'text', 'Order', 1, 0, 0, 0, 0, 0, "{}", 6],
            ['parent_id', 'text', 'Parent Id', 0, 0, 0, 0, 0, 0, "{}", 7],
            ['component_belongstomany_component_relationship', 'relationship', 'components', 0, 1, 1, 1, 1, 1, "{\"foreign_pivot_key\":\"template_id\",\"related_pivot_key\":\"component_id\",\"parent_key\":\"id\",\"model\":\"App\\\\Models\\\\Component\",\"table\":\"components\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"component_template\",\"pivot\":\"1\",\"taggable\":\"0\"}", 8],
            ['component_belongstomany_category_relationship', 'relationship', 'categories', 0, 1, 1, 1, 1, 1, "{\"model\":\"App\\\\Models\\\\Category\",\"table\":\"categories\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"category_component\",\"pivot\":\"1\",\"taggable\":\"on\"}", 9],
        ],
        'providers' => [
            ['id', 'text', 'Id', 1, 0, 0, 0, 0, 0, "{}", 1],
            ['target', 'text', 'Target', 1, 0, 0, 1, 1, 0, "{}", 5],
            ['title', 'text', 'Title', 1, 1, 1, 1, 1, 1, "{}", 3],
            ['company', 'text', 'Company', 1, 1, 1, 1, 1, 1, "{}", 4],
            ['image', 'image', 'Image', 0, 1, 1, 1, 1, 1, "{}", 2],
        ],
        'attributes' => [
            ['id_name', 'text', 'Id Name', 1, 1, 1, 1, 1, 1, "{}", 1],
            ['name', 'text', 'Name', 1, 1, 1, 1, 1, 1, "{}", 4],
            ['img', 'media_picker', 'Img', 0, 1, 1, 1, 1, 1, "{}", 5],
            ['type', 'text', 'Type', 1, 1, 1, 1, 1, 1, "{}", 6],
            ['description', 'text', 'Description', 0, 0, 1, 1, 1, 1, "{}", 7],
            ['value', 'text', 'Value', 1, 1, 1, 1, 1, 1, "{}", 8],
            ['readable', 'text', 'Readable', 0, 1, 1, 1, 1, 1, "{}", 9],
            ['attributable_id', 'text', 'Entity ID', 1, 1, 1, 1, 1, 1, "{}", 2],
            ['attributable_type', 'text', 'Entity Type', 1, 1, 1, 1, 1, 1, "{\"default\":\"App\\\\Models\\\\Component\",\"options\":{\"App\\\\Models\\\\Component\":\"Component Attribute\",\"App\\\\Models\\\\Edge\":\"Edge Attribute\"}}", 3],
        ], 
        'edge-constraints' => [['id', 'text', 'Id', 1, 0, 0, 0, 0, 0, "{}", 1],
            ['type', 'text', 'Type', 1, 1, 1, 1, 1, 1, "{\"default\":\"Allow\",\"options\":{\"Allow\":\"Allow\",\"Exclude\":\"Exclude\"}}", 5],
            ['edge_id', 'text', 'Edge Id', 1, 0, 0, 0, 0, 0, "{}", 2],
            ['from_component_id', 'text', 'From Component Id', 1, 0, 0, 0, 0, 0, "{}", 3],
            ['to_component_id', 'text', 'To Component Id', 1, 0, 0, 0, 0, 0, "{}", 4],
            ['edge_constraint_belongsto_edge_relationship', 'relationship', 'Edge', 0, 1, 1, 1, 1, 1, "{\"model\":\"App\\\\Models\\\\Edge\",\"table\":\"edges\",\"type\":\"belongsTo\",\"column\":\"edge_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"attribute_component\",\"pivot\":\"0\",\"taggable\":\"0\"}", 6],
            ['edge_constraint_belongsto_component_relationship', 'relationship', 'From', 0, 1, 1, 1, 1, 1, "{\"model\":\"App\\\\Models\\\\Component\",\"table\":\"components\",\"type\":\"belongsTo\",\"column\":\"from_component_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"attribute_component\",\"pivot\":\"0\",\"taggable\":\"0\"}", 7],
            ['edge_constraint_belongsto_component_relationship_1', 'relationship', 'components', 0, 1, 1, 1, 1, 1, "{\"model\":\"App\\\\Models\\\\Component\",\"table\":\"components\",\"type\":\"belongsTo\",\"column\":\"to_component_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"attribute_component\",\"pivot\":\"0\",\"taggable\":\"0\"}", 8]
        ],
        'edges' => [
            ['id', 'text', 'Attributes', 1, 0, 0, 1, 1, 0, "{\"view\":\"edges.formfields\"}", 2],
            ['name', 'text', 'Name', 1, 1, 1, 1, 1, 1, "{}", 1],
            ['provider_id', 'text', 'Provider Id', 1, 0, 0, 1, 1, 0, "{}", 4],
            ['edge_belongsto_provider_relationship', 'relationship', 'Provider', 0, 1, 1, 1, 1, 1, "{\"model\":\"App\\\\Models\\\\Provider\",\"table\":\"providers\",\"type\":\"belongsTo\",\"column\":\"provider_id\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"attribute_component\",\"pivot\":\"0\",\"taggable\":\"0\"}", 3],
        ],
        'categories' => [
            ['id', 'text', 'Id', 1, 0, 0, 0, 0, 0, "{}", 1],
            ['name', 'text', 'Name', 1, 1, 1, 1, 1, 1, "{}", 3],
            ['provider_id', 'text', 'Provider Id', 1, 1, 1, 1, 1, 1, "{}", 2],
        ]
        ];
        
 
        // 0 `field` 
        // 1 `type`
        // 2 `display_name`
        // 3 `required`
        // 4 `browse`
        // 5 `read`
        // 6 `edit`
        // 7 `add` 
        // 8 `delete`
        // 9 `details`
        // 10 `order`
  
        foreach ($dataRows[$dataType->slug] as $row) {
            $dataRow = $this->dataRow($dataType, $row[0]);
            if (!$dataRow->exists) {
                $dataRow->fill([
                    'type'         => $row[1],
                    'display_name' => $row[2],
                    'required'     => $row[3],
                    'browse'       => $row[4],
                    'read'         => $row[5],
                    'edit'         => $row[6],
                    'add'          => $row[7],
                    'delete'       => $row[8],
                    'details'      => json_decode($row[9], true),
                    'order'        => $row[10],
                ])->save();
            }
        }
    }
    
    public function insert_menu_items()
    {
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $menuItems = [['Components', '', '_self', 'voyager-boat', NULL, NULL, 7, '2021-01-18 07:51:00', '2021-01-18 07:56:18', 'voyager.components.index', NULL],
        ['Providers', '', '_self', 'voyager-boat', NULL, NULL, 8, '2021-01-18 09:37:08', '2021-01-18 09:37:08', 'voyager.providers.index', NULL],
        ['Attributes', '', '_self', 'voyager-boat', NULL, NULL, 9, '2021-01-19 12:58:27', '2021-01-19 12:58:27', 'voyager.attributes.index', NULL],
        ['Edge Constraints', '', '_self', 'voyager-boat', NULL, NULL, 10, '2021-02-01 10:26:36', '2021-02-01 10:26:36', 'voyager.edge-constraints.index', NULL],
        ['Edges', '', '_self', 'voyager-boat', NULL, NULL, 11, '2021-02-01 10:47:02', '2021-02-01 10:47:02', 'voyager.edges.index', NULL],
        ['Categories', '', '_self', 'voyager-boat', NULL, NULL, 12, '2021-02-03 07:22:08', '2021-02-03 07:22:08', 'voyager.categories.index', NULL]];

 
        // 0 `title`, 
        // 1 `url`, 
        // 2 `target`, 
        // 3 `icon_class`, 
        // 4 `color`, 
        // 5 `parent_id`, 
        // 6 `order`, 
        // 7 `created_at`, 
        // 8  `updated_at`, 
        // 9  `route`, 
        // 10 `parameters`
        foreach ($menuItems as &$item){
            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => $item[0],
                'url'     => '',
                'route'   => $item[9],
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => $item[2],
                    'icon_class' => $item[3],
                    'color'      => $item[4],
                    'parent_id'  => $item[5],
                    'order'      => $item[6]
                ])->save();
            }
        }
    }
}
