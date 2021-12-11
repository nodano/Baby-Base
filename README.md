# Babe-Base

## Development

### XDebug(PHP)

1. XDebug のインストール
1. php.ini の編集
   ```
   [XDebug]
   zend_extension = "〇〇\〇〇\~~~.dll" // xdebugのフルパス。このコメントは削除すること
   xdebug.mode=debug
   xdebug.start_with_request=yes
   xdebug.client_port = 9003
   ```
1. VSCode で PHP Debug の拡張をインストール
