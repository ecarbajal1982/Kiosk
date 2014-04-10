create table inventory
(
        tag             char(5) primary key,
        make            char(25) not null,
        model           char(20) not null,
        serial          char(40) not null,
	purchase_date	date not null,
	purchase_by	varchar(25),
        department      varchar(25) not null,
        fname           varchar(30),
        lname           varchar(50),
	location	varchar(3) not null,
        building        char(2) not null,
        room            varchar(6) not null,
        os              varchar(20),
        mac             varchar(12),
        wmac            varchar(12),
        printer         varchar(30),
        notes           text
);	
