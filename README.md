# php-validator

一般的なバリデーション機能を提供します。

個別に利用出来るほか、複数のバリデーションをつなげて利用する事も出来ます。

## バリデータ一覧

バリデータ名 					| 説明
----------------------------|-------------------------------------------------
AlumValidator 				| アルファベットと数字のみを含む文字列かどうかを判定します.
DataTypeValidator 			| 値の型を判定します.
GEValidator 				| 指定された数値より、大きいか等しい数値かを判定します.
GTValidator 				| 指定された数値より大きいかを判定します.
LEValidator 				| 指定された数値より小さいか等しいかを判定します.
LTValidator 				| 指定された数値より小さいかを判定します.
NotEmptyValidator 			| 値が空ではないかを判定します.
NotNullValidator 			| 値が null ではないかを判定します.
RegularExpressionValidator 	| 正規表現で判定します.
StrLengthValidator 			| 文字列の長さを判定します.
