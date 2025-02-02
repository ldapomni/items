<?php
 $itemsType=[
        ["id"=>1,"name"=>"Счет - банк", "params" =>
                       [ 
                         ["ident"=>"bankName",  "type"=>"text",    "name"=>"Название банка", "size"=>4],
			 ["ident"=>"nsch",      "type"=>"text",    "name"=>"Номер счета",    "size"=>4],
                         ["ident"=>"amount",    "type"=>"text",    "name"=>"Cумма",          "size"=>2],
                         ["ident"=>"currency",  "type"=>"select",  "name"=>"Валюта",         "size"=>2, "dict"=>"Currency"],
                       ],
        ],
        ["id"=>2,"name"=>"Касса - сумма", "params" =>
                       [ 
                         ["ident"=>"amount",    "type"=>"text",    "name"=>"Cумма",  "size"=>2],
                         ["ident"=>"currency",  "type"=>"select",  "name"=>"Валюта", "size"=>2,   "dict"=>"Currency"],
                       ],
        ],
        ["id"=>3,"name"=>"Касса -  иное", "params" =>
                       [ 
                         ["ident"=>"box",       "type"=>"text",    "name"=>"Наименование актива","size"=>4],
                         ["ident"=>"amount",    "type"=>"text",    "name"=>"Cумма",  "size"=>2],
                         ["ident"=>"currency",  "type"=>"select",  "name"=>"Валюта", "size"=>2,          "dict"=>"Currency"],
                       ],
        ],
        ["id"=>4,"name"=>"Строение", "params" =>
                       [ 
                         ["ident"=>"address",         "type"=>"text",  "name"=>"Адрес строения","size"=>4],
                         ["ident"=>"buildYear",       "type"=>"text",  "name"=>"Год постройки","size"=>2],
                         ["ident"=>"startCost",       "type"=>"text",  "name"=>"Начальная стоимость","size"=>2],
                         ["ident"=>"endСost",         "type"=>"text",  "name"=>"Остаточная стоимость","size"=>2],
                         ["ident"=>"estimatedСost",   "type"=>"text",  "name"=>"Оценочная стоимость","size"=>2],
                         ["ident"=>"currency",        "type"=>"select","name"=>"Валюта","size"=>2,            "dict"=>"Currency"],
                         ["ident"=>"inventoryNumber", "type"=>"text",  "name"=>"Инвентарный номер","size"=>3],
                       ],
        ],
        ["id"=>5,"name"=>"Весовой актив", "params" =>
                       [ 
                         ["ident"=>"name",            "type"=>"text",  "name"=>"Наименование","size"=>4],
                         ["ident"=>"weight",          "type"=>"text",  "name"=>"Вес","size"=>2],
                         ["ident"=>"factoryYear",     "type"=>"text",  "name"=>"Год изготовления","size"=>2],
                         ["ident"=>"startCost",       "type"=>"text",  "name"=>"Начальная стоимость","size"=>2],
                         ["ident"=>"endСost",         "type"=>"text",  "name"=>"Остаточная стоимость","size"=>2],
                         ["ident"=>"estimatedСost",   "type"=>"text",  "name"=>"Рыночная стоимость","size"=>2],
                         ["ident"=>"currency",        "type"=>"select","name"=>"Валюта","size"=>2,            "dict"=>"Currency"],
                         ["ident"=>"inventoryNumber", "type"=>"text",  "name"=>"Оценочная стоимость","size"=>2],
                       ],
        ],
 ];
  $dict=[];
  $dict['Currency'][0]='Рубль';
  $dict['Currency'][1]='Доллар';
  $dict['Currency'][2]='Евро';

