<?php

function getUniqueRecords(array $records): array
{
    return array_values(array_column($records, null, 'id'));
}

function sortRecordsByKey(array $records, string $key): array
{
    usort($records, function ($a, $b) use ($key) {
        if ($key === 'date') {
            $a[$key] = DateTime::createFromFormat('d.m.Y', $a[$key]);
            $b[$key] = DateTime::createFromFormat('d.m.Y', $b[$key]);
        }

        return $a[$key] <=> $b[$key];
    });

    return $records;
}

function filterRecordsByCondition(array $records, string $conditionKey, int|string $conditionValue): array
{
    return array_filter($records, function ($item) use ($conditionKey, $conditionValue) {
        return $item[$conditionKey] === $conditionValue;
    });
}

function transformRecords(array $records): array
{
    return array_combine(array_column($records, 'name'), array_column($records, 'id'));
}

// Исходный массив
$records = [
    ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
    ['id' => 2, 'date' => "02.05.2020", 'name' => "test2"],
    ['id' => 4, 'date' => "08.03.2020", 'name' => "test4"],
    ['id' => 1, 'date' => "22.01.2020", 'name' => "test1"],
    ['id' => 2, 'date' => "11.11.2020", 'name' => "test4"],
    ['id' => 3, 'date' => "06.06.2020", 'name' => "test3"],
];

// Уникальные записи по ключу 'id'
$uniqueRecords = getUniqueRecords($records);

// Сортировка записей по ключу 'date'
$sortedRecords = sortRecordsByKey($records, 'date');

// Фильтрация записей по ключу 'id' и значению '2'
$filteredRecords = filterRecordsByCondition($records, 'id', 2);

// Преобразование массива записей
$transformedArray = transformRecords($records);

var_dump($transformedArray);