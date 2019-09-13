DB::statement("SET @count = 0;");
DB::statement("UPDATE `_table_` SET `_table_`.`_kolom_` = @count:= @count + 1;");
DB::statement("ALTER TABLE `_table_` AUTO_INCREMENT = 1;");
