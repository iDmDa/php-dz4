<?
/*
1. Придумайте класс, который описывает любую сущность из предметной области библиотеки: книга, шкаф, комната и т.п.

2. Опишите свойства классов из п.1 (состояние).

3. Опишите поведение классов из п.1 (методы).

4. Придумайте наследников классов из п.1. Чем они будут отличаться?

5. Создайте структуру классов ведения книжной номенклатуры.
— Есть абстрактная книга.
— Есть цифровая книга, бумажная книга.
— У каждой книги есть метод получения на руки.

У цифровой книги надо вернуть ссылку на скачивание, а у физической – адрес библиотеки, где ее можно получить. У всех книг формируется в конечном итоге статистика по кол-ву прочтений.
Что можно вынести в абстрактный класс, а что надо унаследовать?

*****************

1. Класс, описывающий сущность библиотеки: Bookcase (Шкаф)

2. Свойства класса Bookcase:
    shelves: массив, описывающий полки в шкафу (каждая полка содержит массив книг).
    capacity: максимальное количество книг, которое может быть размещено в шкафу.
    location: строка, описывающая местоположение шкафа.
    material: материал, из которого сделан шкаф.

3. Методы класса Bookcase:
    addBook($book, $shelfIndex): добавляет книгу на указанную полку.
    removeBook($bookId, $shelfIndex): удаляет книгу с указанной полки.
    listBooks(): возвращает список всех книг в шкафу.
    isFull(): проверяет, заполнен ли шкаф.

4. Наследники класса Bookcase
    DigitalBookcase (Цифровой шкаф):
    Свойства: вместо физических книг содержит ссылки на цифровые книги.
    Методы: downloadBook($bookId) — возвращает ссылку на скачивание книги.
    LockedBookcase (Закрытый шкаф):
    Свойства: добавлено поле lockCode (код доступа к шкафу).
    Методы: unlock($code) и lock().
*/

//5. Структура классов для ведения книжной номенклатуры
//Абстрактный класс Book:

abstract class Book {
    protected $title;
    protected $author;
    protected $readCount = 0;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
    }

    abstract public function getAccessMethod();

    public function incrementReadCount() {
        $this->readCount++;
    }

    public function getReadCount() {
        return $this->readCount;
    }
}

//Наследники:
//Цифровая книга (DigitalBook):

class DigitalBook extends Book {
    private $downloadLink;

    public function __construct($title, $author, $downloadLink) {
        parent::__construct($title, $author);
        $this->downloadLink = $downloadLink;
    }

    public function getAccessMethod() {
        return "Ссылка для скачивания: " . $this->downloadLink;
    }
}

//Бумажная книга (PhysicalBook):

class PhysicalBook extends Book {
    private $libraryAddress;

    public function __construct($title, $author, $libraryAddress) {
        parent::__construct($title, $author);
        $this->libraryAddress = $libraryAddress;
    }

    public function getAccessMethod() {
        return "Книга доступна по адресу: " . $this->libraryAddress;
    }
}


//6. Дан код:

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo(); // Выведет: 1
$a2->foo(); // Выведет: 2
$a1->foo(); // Выведет: 3
$a2->foo(); // Выведет: 4

/*
static $x — статическая переменная, сохраняющая своё значение между вызовами метода. 
Она принадлежит самому классу A, а не экземплярам, поэтому все вызовы метода foo() 
работают с одной и той же переменной $x.
*/

class A1 {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A1 {
    //public function foo() {
    //    echo ++$x;
    //}
}

$a1 = new A1();
$b1 = new B();
$a1->foo(); // 1
$b1->foo(); // 1
$a1->foo(); // 2
$b1->foo(); // 2

/*
Каждый класс (A1 и B) имеет свою собственную копию статической переменной $x. 
Несмотря на то, что класс B наследует A1, статические переменные не являются общими для классов. 
Поэтому $x для класса A1 и $x для класса B отслеживаются отдельно.
*/


//docker run -it --rm -v "${PWD}/:/app" -w /app php:7.2-cli php index.php
//в версии 8.2 выводит 1234 1234