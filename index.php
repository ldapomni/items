<?php

require __DIR__ . "/itemsType.php";

//TODO Validation
//TODO Mask

//роутинг
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'] ?? '';

//Перечень активов
if ($method === 'GET' && $path === '/api/getFormTypes') {

    $html = '<select hx-get="/api/getForm" hx-target="#formContainer" name="getForm" class="form-select w-4">';
    $html .= '<option value="">Выберите тип актива</option>';
    foreach ($itemsType as $v) {
        $html .= '<option value="' . $v['id'] . '">' . $v['name'] . '</option>';
    };
    $html = $html . "</select></form>";
    exit($html);
};

//Форма с данными или без
if ($method === 'GET' && $path === '/api/getForm') {
    $id = $_GET['id'] ?? '';
    $formId = $_GET['getForm'] ?? '';
    $fill = false;
    $record = [];
    if (!empty($id)) {
        $data = getData();
        $record = $data[$id];
        $fill = true;
    }
    if (!empty($formId)) {
        $record['itemsType'] = $formId;
    }
    $form = buildForm($itemsType, $dict, $id, $record, $fill, true);
    exit($form);
};

//Запись данных из формы
if ($method === 'POST' && $path === '/api/saveRecord') {
    $data = getData();
    $id = $_POST['id'] ?? '';
    if (!empty($id)) {
        $data[$id] = $_POST;
    } else {
        $data[uniqid()] = $_POST;
    }
    putData($data);
    header('HX-Trigger: recordUpdate');
    exit();
};

//Вывод всех данных или определенную по id
if ($method === 'GET' && $path === '/api/getRecord') {
    $id = $_GET['id'] ?? '';
    $data = getData();
    $html = '';
    if (!empty($id)) {
        if (isset($data[$id])) {
            $html = buildForm($itemsType, $dict, $id, $data[$id], true, false);
        } else {
            $html = 'Такой записи нет';
        }
    } else {
        $data = array_reverse(getData());
        foreach ($data as $id => $record) {
            $html .= buildForm($itemsType, $dict, $id, $record, true);
        }
    }
    exit($html);
};

//Удвление записи
if ($method === 'DELETE' && $path === '/api/delRecord') {
    $id = $_GET['id'] ?? '';
    $data = getData();
    unset($data[$id]);
    putData($data);
    header('HX-Trigger: recordUpdate');
    exit();
};

//Построение формы по описанию из itemsType
function buildForm(&$itemsType, &$dict, $id, $record, $fill = false, $form = false)
{
    $type = [];$header='';
    foreach ($itemsType as $items) {
        if ($items['id'] == $record['itemsType']) {
            $type = $items;
            $header=$items['name'];
            break;
        }
    }
    if (empty($type)) {
        exit("<div>Неизвестный актив!</div>");
    }
    if (!empty($id)) {
        $felement = '<div id="record-' . $id . '">';
    } else {
        $felement = '<div class="record">';
    };
       $felement .= '<div class="card m-1"><div class="card-header">Актив: '.$header.'</div><div class="card-body"><form hx-post="/api/saveRecord" hx-target="#items">';
    $felement .= '<div class="row">';
    foreach ($type['params'] as $el) {

        if ($el['type'] == 'text') {

            $val = '';
            if ($fill) {
                $val = $record[$el['ident']];
            };
            if ($form) {
                $validate='';
                $setForm = '<input type="text" name="' . $el['ident'] . '" value="' . $val . '" placeholder="' . $el['name'] . '" class="form-control m-1">';
            } else {
                $setForm = $el['name'] . ' <strong>' . $val . '</strong>';
            };
            $felement .= '<div class="col-' . $el['size'] . '">' . $setForm . '</div>';
        }
        if ($el['type'] == 'select') {
            if ($form) {
                $felement .= '<div class="col-' . $el['size'] . ' "><select name="' . $el['ident'] . '" class="form-select m-1">';
                foreach ($dict[$el['dict']] as $key => $val) {
                    $selected = '';
                    if ($fill && ($key == $record[$el['ident']])) {
                        $selected = 'selected';
                    }
                    $felement .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
                }
                $felement .= '</select></div>';
            } else {
                $felement .= '<div class="col-' . $el['size'] . '">' . $el['name'] . ' <strong>' . $dict[$el['dict']][$record[$el['ident']]] . '</strong></div>';
            }
        };
    };
    $felement .= '<input type="hidden" name="itemsType" value="' . $type['id'] . '">';
    $felement .= '<input type="hidden" name="id" value="' . $id . '">';
    if (!$form) {
        $felement .= <<<HTML
                        <div class='row mb-1 mt-1 '>
                                <div class='col-12 text-end'>
                                        <button hx-get="/api/getForm?form={$type['id']}&id={$id}"
                                                hx-target="#record-{$id}"
                                                class="btn btn-sm btn-primary"
                                                hx-swap="outerHTML"
                                                >
                                                Редактировать
                                        </button>
                                        <button hx-delete="/api/delRecord?id={$id}"
                                                hx-confirm="Удалить запись?"
                                                class="btn btn-sm btn-danger"
                                                >
                                                Удалить
                                        </button>
                                </div>
                        </div>
                HTML;
    } else {
        $felement .= '<div class="row mb-1 mt-1 "><div class="col-12 text-end"><button class="btn btn-primary btn-sm">Сохранить</button>';
        if (!empty($id)) {
            $felement .= <<<HTML
                                <button hx-get="/api/getRecord?id={$id}"
                                                hx-target="#record-{$id}"
                                                class="btn btn-sm btn-secondary"
                                                hx-swap="outerHTML"
                                                >
                                                Отмена
                                </button>
                HTML;
            $felement .= "</div></div></div></form>";
        };
    };
    $felement .= "</div></div></div></div>";
    return $felement;
}
//Чтение данных
function getData()
{
    $data = [];
    if (file_exists(__DIR__ . "/data.json")) {
        $all = file_get_contents(__DIR__ . "/data.json");
        $data = json_decode($all, true);
    }
    return $data;
};

//Запись данных
function putData($data)
{
    file_put_contents(__DIR__ . '/data.json', json_encode($data));
};
