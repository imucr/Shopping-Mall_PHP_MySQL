insert into categories values(100, '컴퓨터');
insert into categories values(200, '소설');
insert into categories values(300, '역사');
insert into categories values(400, '참고서');


--특정 테이블의 default character set 확인 방법--
show create table categories;


--특정 테이블의 특정 칼럼의 default character set 수정하는 방법--
alter table categories modify cat_name varchar(50) character set utf8;



insert into books values('1234512345', '김자바', '자바 프로그래밍 입문',100,30000,'프로그래밍을 처음 시작하는 분들의 눈높이에 맞게 만들어진 책으로 쉽고 빠르게 자바 프로그래밍을 익힐 수 있다.');
insert into books values('1234412344', '김PH', 'PHP 프로그래밍 입문',100,28000,'프로그래밍을 처음 시작하는 분들의 눈높이에 맞게 만들어진 책으로 쉽고 빠르게 PHP 프로그래밍을 익힐 수 있다.');
insert into books values('1235512355', '김C', 'C 프로그래밍 입문',100,20000,'프로그래밍을 처음 시작하는 분들의 눈높이에 맞게 만들어진 책으로 쉽고 빠르게 C 프로그래밍을 익힐 수 있다.');
insert into books values('3235532355', '한역사', '한국사 교과서',300,22000,'한국사를 처음 시작하는 분들의 눈높이에 맞게 만들어진 책으로 쉽고 빠르게 한국사를 배울 수 있다.');


insert into admin values('admin', sha1('admin1234'));