<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');
App::import('Vendor', 'StringParser_BBCode', array('file' => 'bbcode' . DS . 'stringparser_bbcode.class.php'));

function convertlinebreaks ($text) {
  return preg_replace ("/\015\012|\015|\012/", "\n", $text);
}

//Удалить все символы, кроме переводов строк
function bbcode_stripcontents ($text) {
  return preg_replace ("/[^\n]/", '', $text);
}

//Функция для обработки ссылок
function do_bbcode_url ($action, $attributes, $content, $params, $node_object) {
  if (!isset ($attributes['default'])) {
      $url = $content;
      $text = htmlspecialchars ($content);
  } else {
      $url = $attributes['default'];
      $text = $content;
  }
  //Часть функции, которая занимается
  //только валидацией данных тэга
  if ($action == 'validate') {
      if (substr ($url, 0, 5) == 'data:' || substr ($url, 0, 5) == 'file:'
        || substr ($url, 0, 11) == 'javascript:' || substr ($url, 0, 4) == 'jar:') {
          return false;
      }
      return true;
  }
  //Непосредственное преобразование тэга в
  //html вариант с возвращением результата
  return '<a href="'.htmlspecialchars ($url).'">'.$text.'';
}

// Функция для вставки изображений
function do_bbcode_img ($action, $attributes, $content, $params, $node_object) {
  //Часть функции, которая занимается
  //только валидацией данных тэга
  if ($action == 'validate') {
      if (substr ($content, 0, 5) == 'data:' || substr ($content, 0, 5) == 'file:'
        || substr ($content, 0, 11) == 'javascript:' || substr ($content, 0, 4) == 'jar:') {
          return false;
      }
      return true;
  }
  //Непосредственное преобразование тэга в
  //html вариант с возвращением результата
  return '<img src="'.htmlspecialchars($content).'" alt=""/>';
}
	
class BbcodeHelper extends AppHelper {
	
	private $bbcode;
   	 //Приводит разнообразные переводы строк
	//разных операционных систем в единый формат (\n)
	public function beforeRender(){
		

		//Создаем объект класса StringParser_BBCode
		$bbcode = new StringParser_BBCode();

		//Добавляем фильтр (подробнее см. офф. документацию),
		//задействуя нашу функцию convertlinebreaks, которая будет
		//преобразовывать переводы строки в тексте к единому
		$bbcode->addFilter (STRINGPARSER_FILTER_PRE, 'convertlinebreaks');

		//Добавляем свои парсеры для разных типов объектов
		//(подробнее см. офф. документацию)
		//Мы указываем, через какую функцию должно пройти
		//содержимое этих тэгов, например, через функцию
		//htmlspecialchars для предотвращения XSS и т.д.
		$bbcode->addParser (array ('block', 'inline', 'link', 'listitem'), 'htmlspecialchars');
		$bbcode->addParser (array ('block', 'inline', 'link', 'listitem'), 'nl2br');
		$bbcode->addParser ('list', 'bbcode_stripcontents');

		//Добавляем bb-код [h1], используемый в виде:
		//[h1]Текст заголовка первого уровня[/h1]
		$bbcode->addCode ('h1', 'simple_replace', null, array ('start_tag' => '<h1>', 'end_tag' => '</h1>'),
		                'block', array ('listitem', 'block', 'link'), array ());
		//Добавляем bb-код [h2], используемый в виде:
		//[h2]Текст заголовка второго уровня[/h2]
		$bbcode->addCode ('h2', 'simple_replace', null, array ('start_tag' => '<h2>', 'end_tag' => '</h2>'),
		                'block', array ('listitem', 'block', 'link'), array ());
		//Добавляем bb-код [h3], используемый в виде:
		//[h3]Текст заголовка третьего уровня[/h3]
		$bbcode->addCode ('h3', 'simple_replace', null, array ('start_tag' => '<h3>', 'end_tag' => '</h3>'),
		                'block', array ('listitem', 'block', 'link'), array ());
		//Добавляем bb-код [h4], используемый в виде:
		//[h4]Текст заголовка четвертого уровня[/h4]
		$bbcode->addCode ('h4', 'simple_replace', null, array ('start_tag' => '<h4>', 'end_tag' => '</h4>'),
		                'block', array ('listitem', 'block', 'link'), array ());
		//Добавляем bb-код [h5], используемый в виде:
		//[h5]Текст заголовка пятого уровня[/h5]
		$bbcode->addCode ('h5', 'simple_replace', null, array ('start_tag' => '<h5>', 'end_tag' => '</h5>'),
		                'block', array ('listitem', 'block', 'link'), array ());
		//Добавляем bb-код [h6], используемый в виде:
		//[h6]Текст заголовка шестого уровня[/h6]
		$bbcode->addCode ('h6', 'simple_replace', null, array ('start_tag' => '<h6>', 'end_tag' => '</h6>'),
		                'block', array ('listitem', 'block', 'link'), array ());

		//Устанавливаем флаги для bb-кодов с h1 до h6,
		//указывая, что они являются блочными элементами,
		//что будет в дальнейшем благотворно влиять на умную
		//генерацию html кода. Такой элемент, к примеру, не сможет
		//находиться внутри других блочных элементов
		$bbcode->setCodeFlag('h1', 'paragraph_type', BBCODE_PARAGRAPH_BLOCK_ELEMENT);
		$bbcode->setCodeFlag('h2', 'paragraph_type', BBCODE_PARAGRAPH_BLOCK_ELEMENT);
		$bbcode->setCodeFlag('h3', 'paragraph_type', BBCODE_PARAGRAPH_BLOCK_ELEMENT);
		$bbcode->setCodeFlag('h4', 'paragraph_type', BBCODE_PARAGRAPH_BLOCK_ELEMENT);
		$bbcode->setCodeFlag('h5', 'paragraph_type', BBCODE_PARAGRAPH_BLOCK_ELEMENT);
		$bbcode->setCodeFlag('h6', 'paragraph_type', BBCODE_PARAGRAPH_BLOCK_ELEMENT);

		//Добавляем bb-код [b], используемый в виде:
		//[b]выделенный текст[/b]
		$bbcode->addCode ('b', 'simple_replace', null, array ('start_tag' => '<b>', 'end_tag' => '</b>'),
		                'inline', array ('listitem', 'block', 'inline', 'link'), array ());
		//Добавляем bb-код [i], используемый в виде:
		//[i]наклонный текст[/i]
		$bbcode->addCode ('i', 'simple_replace', null, array ('start_tag' => '<i>', 'end_tag' => '</i>'),
		                'inline', array ('listitem', 'block', 'inline', 'link'), array ());
		//Добавляем bb-код [url], используемый в виде:
		//[url]http://www.needsite.domain[/url] и
		//[url=http://www.needsite.domain]Текст ссылки[/url]
		$bbcode->addCode ('url', 'usecontent?', 'do_bbcode_url', array ('usecontent_param' => 'default'),
		                'link', array ('listitem', 'block', 'inline'), array ('link'));
		//Добавляем bb-код [link], используемый в виде:
		//[link]http://www.needsite.domain[/link]
		$bbcode->addCode ('link', 'callback_replace_single', 'do_bbcode_url', array (),
		                'link', array ('listitem', 'block', 'inline'), array ('link'));
		//Добавляем bb-код [img], используемый в виде:
		//[img]http://www.needsite.domain/img.jpg[/img]
		$bbcode->addCode ('img', 'usecontent', 'do_bbcode_img', array (),
		                'image', array ('listitem', 'block', 'inline', 'link'), array ());
		//Добавляем bb-код [bild] (по смыслу то же самое,
		//что и [img]), используемый в виде:
		//[bild]http://www.needsite.domain/img.jpg[/bild]
		$bbcode->addCode ('bild', 'usecontent', 'do_bbcode_img', array (),
		                'image', array ('listitem', 'block', 'inline', 'link'), array ());

		//Создаем группу image из bb-кодов img и bild
		//для последующей возможности задания
		//неких правил для этих групп
		$bbcode->setOccurrenceType ('img', 'image');
		$bbcode->setOccurrenceType ('bild', 'image');
		//Указываем, что тэги из группы image
		//могут встречаться (обрабатываться) в тексте не более
		//двух раз. В нашем случае это нужно для того,
		//чтобы пользователь не мог вставить более двух
		//картинок в текст сообщения
		$bbcode->setMaxOccurrences ('image', 2);

		//Добавляем bb-код [list]
		$bbcode->addCode ('list', 'simple_replace', null, array ('start_tag' => '<ul>', 'end_tag' => '</ul>'),
		                'list', array ('block', 'listitem'), array ());
		//Добавляем bb-код [*], указывая, что этот тэг
		//может использоваться только внутри тэга
		//с типом list (этот тип мы присвоили выше тэгу [list])
		$bbcode->addCode ('*', 'simple_replace', null, array ('start_tag' => '<li>', 'end_tag' => '</li>'),
		                'listitem', array ('list'), array ());

		//Устанавливаем флаги для тэгов [list] и [*]
		//Указываем, что для кода [*] закрывающийся тэг
		//не обязателен, таким образом, возможна будет
		//следующая конструкция:
		//[list]
		//[*] Item
		//[*] Item
		//[/list]
		//Закрывающий тэг будет добавляться автоматически
		//в процессе формирования html кода
		$bbcode->setCodeFlag ('*', 'closetag', BBCODE_CLOSETAG_OPTIONAL);
		//Как я понял, этот флаг обозначает, что тэг [*]
		//всегда может быть использован только
		//в начале новой строки
		$bbcode->setCodeFlag ('*', 'paragraphs', true);
		//[list] является блочным элементом
		$bbcode->setCodeFlag ('list', 'paragraph_type', BBCODE_PARAGRAPH_BLOCK_ELEMENT);
		//Перед открывающимся тэгом [list]
		//символ строки будет устранен
		$bbcode->setCodeFlag ('list', 'opentag.before.newline', BBCODE_NEWLINE_DROP);
		//Перед закрывающимся тэгом [list]
		//символ строки будет устранен
		$bbcode->setCodeFlag ('list', 'closetag.before.newline', BBCODE_NEWLINE_DROP);
		//В итоге мы можем использовать списки в bb-коде,
		//используя вместе теги list и *:
		//[list]
		//[*] Элемент списка
		//[*] Элемент списка
		//[*] и т.д.
		//[/list]

		//Активируем обработку параграфов
		$bbcode->setRootParagraphHandling (true);
		//Как я понял, таким образом указывается,
		//какими символами нужно заменять встреченный
		//перенос строки внутри абзаца
		//(по сути, как обрабатывать пустые абзацы).
		$bbcode->setParagraphHandlingParameters ("\n", '<p>', '</p>');

		//$res_text = "Тестовый текст [b]для проверки[/b] работы класса";

		//На всякий случай удаляем все оставшиеся
		//символы переноса строки в виде "\r",
		//если такие остались в тексте
		//$res_text = str_replace("\r", '', $res_text);

		//Вуаля!
		//echo $bbcode->parse($res_text);
		$this->bbcode = $bbcode;
		}




	public function parsebbcode($text){
		
		echo  $this->bbcode->parse($text);
	}

}