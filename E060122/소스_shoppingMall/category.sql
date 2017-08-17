use sm;

insert into categories values(100, '컴퓨터');
insert into categories values(200, '소설');
insert into categories values(300, '역사');
insert into categories values(400, '참고서');


--특정 데이터베이스의 default character set 수정하는 방법
--( 데이터베이스에 속해 있는 테이블들의 문자셋은 변경안됨)
alter database SM character set = utf8;

-- 특정 데이터베이스의 default character set 확인방법
show create database SM;

-- 특정 테이블의 default character set 확인 방법
show create table categories;

-- 특정 테이블의 default character set을 수정하는 방법
--(테이블에 있는 각 칼럼들의 문자셋이나 cllation을 변경 하지 않는다.)
alter table categories character set = utf8 collate = utf8_general_ci;

alter table categories modify cat_name varchar(50) character set utf8;


-- 데이터베이스 생성시에 문자 셋팅 방법
-- create database  DB명 character set utf8 collate utf8_general_ci;

insert into books values('1234512345', '김자바', '자바 프로그래밍 입문',100,30000,'프로그래밍을 처음 시작하는 분들의 눈높이에 맞게 만들어진 책으로 쉽고 빠르게 자바 프로그래밍을 익힐 수 있다.');
insert into books values('1234412344', '김PH', 'PHP 프로그래밍 입문',100,28000,'프로그래밍을 처음 시작하는 분들의 눈높이에 맞게 만들어진 책으로 쉽고 빠르게 PHP 프로그래밍을 익힐 수 있다.');
insert into books values('1235512355', '김C', 'C 프로그래밍 입문',100,20000,'프로그래밍을 처음 시작하는 분들의 눈높이에 맞게 만들어진 책으로 쉽고 빠르게 C 프로그래밍을 익힐 수 있다.');

insert into books values('3235532355', '한역사', '한국사 교과서',300,22000,'한국사를 처음 시작하는 분들의 눈높이에 맞게 만들어진 책으로 쉽고 빠르게 한국사를 배울 수 있다.');

insert into admin values('admin', sha1('admin1234'));