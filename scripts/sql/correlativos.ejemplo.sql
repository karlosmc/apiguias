-- Actualizar los correlativos de las series. Solo toca la tabla numeracion.
-- Copia este archivo (cp correlativos.ejemplo.sql correlativos.sql),
-- pon los números y ejecútalo con:
--   bash scripts/ejecutar-sql.sh scripts/sql/correlativos.sql
--
-- numeroActual = el ÚLTIMO número ya usado (la app propone el siguiente).
-- Una línea por serie. Las líneas que empiezan con -- no se ejecutan.

UPDATE numeracion SET numeroActual = 232.00 WHERE serie = 'TX01';
UPDATE numeracion SET numeroActual = 432.00 WHERE serie = 'TX02';
UPDATE numeracion SET numeroActual = 486.00 WHERE serie = 'TX03';
UPDATE numeracion SET numeroActual = 538.00 WHERE serie = 'TX04';
UPDATE numeracion SET numeroActual = 0.00 WHERE serie = 'TX05';
UPDATE numeracion SET numeroActual = 175.00 WHERE serie = 'TX06';
UPDATE numeracion SET numeroActual = 185.00 WHERE serie = 'TX07';
UPDATE numeracion SET numeroActual = 180.00 WHERE serie = 'TX08';
UPDATE numeracion SET numeroActual = 167.00 WHERE serie = 'TX09';
UPDATE numeracion SET numeroActual = 497.00 WHERE serie = 'TX10';
UPDATE numeracion SET numeroActual = 142.00 WHERE serie = 'TX11';
UPDATE numeracion SET numeroActual = 0.00 WHERE serie = 'T900';
UPDATE numeracion SET numeroActual = 48.00 WHERE serie = 'T999';
UPDATE numeracion SET numeroActual = 3415.00 WHERE serie = 'TO01';
UPDATE numeracion SET numeroActual = 1366.00 WHERE serie = 'TO02';
UPDATE numeracion SET numeroActual = 2.00 WHERE serie = 'TA01';
UPDATE numeracion SET numeroActual = 117.00 WHERE serie = 'TX12';
UPDATE numeracion SET numeroActual = 2.00 WHERE serie = 'T107';
UPDATE numeracion SET numeroActual = 0.00 WHERE serie = 'T102';
UPDATE numeracion SET numeroActual = 0.00 WHERE serie = 'T103';
UPDATE numeracion SET numeroActual = 2.00 WHERE serie = 'T104';
UPDATE numeracion SET numeroActual = 0.00 WHERE serie = 'T110';
UPDATE numeracion SET numeroActual = 0.00 WHERE serie = 'T155';
UPDATE numeracion SET numeroActual = 0.00 WHERE serie = 'T106';
UPDATE numeracion SET numeroActual = 7.00 WHERE serie = 'T101';
UPDATE numeracion SET numeroActual = 11.00 WHERE serie = 'T108';
UPDATE numeracion SET numeroActual = 56.00 WHERE serie = 'TL01';
UPDATE numeracion SET numeroActual = 30.00 WHERE serie = 'TL02';
UPDATE numeracion SET numeroActual = 4.00 WHERE serie = 'TL03';
UPDATE numeracion SET numeroActual = 7.00 WHERE serie = 'TL04';
UPDATE numeracion SET numeroActual = 78.00 WHERE serie = 'TL05';
UPDATE numeracion SET numeroActual = 132.00 WHERE serie = 'TL06';
UPDATE numeracion SET numeroActual = 30.00 WHERE serie = 'TL07';
-- UPDATE numeracion SET numeroActual = 0 WHERE serie = 'T002';

-- Comprobar
SELECT id, serie, numeroActual FROM numeracion;
