BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "migrations" (
	"id"	integer NOT NULL,
	"migration"	varchar NOT NULL,
	"batch"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "users" (
	"id"	integer NOT NULL,
	"username"	varchar NOT NULL,
	"email"	varchar NOT NULL,
	"phone"	varchar NOT NULL,
	"email_verified_at"	datetime,
	"password"	varchar NOT NULL,
	"role"	varchar NOT NULL CHECK("role" IN ('0', '1')),
	"remember_token"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "password_resets" (
	"email"	varchar NOT NULL,
	"token"	varchar NOT NULL,
	"created_at"	datetime
);
CREATE TABLE IF NOT EXISTS "failed_jobs" (
	"id"	integer NOT NULL,
	"uuid"	varchar NOT NULL,
	"connection"	text NOT NULL,
	"queue"	text NOT NULL,
	"payload"	text NOT NULL,
	"exception"	text NOT NULL,
	"failed_at"	datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "personal_access_tokens" (
	"id"	integer NOT NULL,
	"tokenable_type"	varchar NOT NULL,
	"tokenable_id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"token"	varchar NOT NULL,
	"abilities"	text,
	"last_used_at"	datetime,
	"expires_at"	datetime,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "classes" (
	"id"	integer NOT NULL,
	"class"	varchar NOT NULL,
	"slug"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "subjects" (
	"id"	integer NOT NULL,
	"title"	varchar NOT NULL,
	"slug"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "tags" (
	"id"	integer NOT NULL,
	"tag"	varchar NOT NULL,
	"slug"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "resources" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"class_id"	integer NOT NULL,
	"subject_id"	integer NOT NULL,
	"tag_id"	integer NOT NULL,
	"title"	varchar NOT NULL,
	"slug"	varchar NOT NULL,
	"price"	varchar,
	"file"	varchar NOT NULL,
	"type"	varchar NOT NULL,
	"size"	varchar NOT NULL,
	"description"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("subject_id") REFERENCES "subjects"("id"),
	FOREIGN KEY("tag_id") REFERENCES "tags"("id"),
	FOREIGN KEY("user_id") REFERENCES "users"("id"),
	FOREIGN KEY("class_id") REFERENCES "classes"("id")
);
CREATE TABLE IF NOT EXISTS "views" (
	"id"	integer NOT NULL,
	"resource_id"	integer NOT NULL,
	"count"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("resource_id") REFERENCES "resources"("id")
);
CREATE TABLE IF NOT EXISTS "downloads" (
	"id"	integer NOT NULL,
	"resource_id"	integer NOT NULL,
	"count"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("resource_id") REFERENCES "resources"("id")
);
INSERT INTO "migrations" VALUES (9,'2014_10_12_000000_create_users_table',1);
INSERT INTO "migrations" VALUES (10,'2014_10_12_100000_create_password_resets_table',1);
INSERT INTO "migrations" VALUES (11,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO "migrations" VALUES (12,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO "migrations" VALUES (13,'2022_09_26_082219_create_classes_table',1);
INSERT INTO "migrations" VALUES (14,'2022_09_26_082227_create_subjects_table',1);
INSERT INTO "migrations" VALUES (15,'2022_09_26_082235_create_tags_table',1);
INSERT INTO "migrations" VALUES (18,'2022_09_26_082252_create_resources_table',2);
INSERT INTO "migrations" VALUES (19,'2022_09_28_074957_create_views_table',3);
INSERT INTO "migrations" VALUES (20,'2022_09_28_075007_create_downloads_table',3);
INSERT INTO "users" VALUES (1,'Admin','admin@admin.com','0773034311',NULL,'$2y$10$Lks51VaeRocRbCx9oJPHpex78ozwDKHQuIUQSiXwBovy4Xtm142XO','1','q95VxOr7WF','2022-09-27 13:29:20','2022-09-27 13:29:20');
INSERT INTO "classes" VALUES (9,'Primary One','primary-one','2022-09-27 13:32:56','2022-09-27 13:32:56');
INSERT INTO "classes" VALUES (10,'Primary two','primary-two','2022-09-27 13:33:06','2022-09-27 13:33:06');
INSERT INTO "classes" VALUES (11,'Primary three','primary-three','2022-09-27 13:33:15','2022-09-27 13:33:15');
INSERT INTO "classes" VALUES (12,'Senior Five','senior-five','2022-09-27 16:33:07','2022-09-27 16:33:07');
INSERT INTO "subjects" VALUES (1,'Physics','physics','2022-09-27 13:31:30','2022-09-27 13:31:30');
INSERT INTO "subjects" VALUES (2,'Mathematics','mathematics','2022-09-27 13:31:38','2022-09-27 13:31:38');
INSERT INTO "subjects" VALUES (3,'Chemistry','chemistry','2022-09-27 13:31:45','2022-09-27 13:31:45');
INSERT INTO "subjects" VALUES (4,'English','english','2022-09-27 16:31:39','2022-09-27 16:31:39');
INSERT INTO "subjects" VALUES (6,'History','history','2022-09-27 16:32:22','2022-09-27 16:32:22');
INSERT INTO "subjects" VALUES (7,'Commerce','commerce','2022-09-27 16:32:35','2022-09-27 16:32:35');
INSERT INTO "tags" VALUES (1,'Lecture Notes','lecture-notes','2022-09-27 13:29:34','2022-09-27 13:29:34');
INSERT INTO "tags" VALUES (2,'Exercise','exercise','2022-09-27 13:29:43','2022-09-27 13:29:43');
INSERT INTO "tags" VALUES (3,'Primary Notes','primary-notes','2022-09-27 13:29:55','2022-09-27 13:29:55');
INSERT INTO "tags" VALUES (4,'Secondary Notes','secondary-notes','2022-09-27 13:30:05','2022-09-27 13:30:05');
INSERT INTO "tags" VALUES (6,'Course Work','course-work','2022-09-27 16:33:31','2022-09-27 16:33:31');
INSERT INTO "resources" VALUES (3,1,11,3,4,'Introduction to Programming','introduction-to-programming','500','1664290961java presentation.pdf','pdf','312227','hello','2022-09-27 15:02:41','2022-09-27 15:53:30');
INSERT INTO "resources" VALUES (4,1,9,1,2,'P3 Science Exercise','p3-science-exercise',NULL,'1664295332brit-invoice.pdf','pdf','82728','Thiis is sample description','2022-09-27 16:15:32','2022-09-27 16:15:32');
INSERT INTO "resources" VALUES (5,1,10,3,1,'Primary 7 Lecture notes','primary-7-lecture-notes','800','1664295475Camp Kennedy Report 2021.pdf','pdf','5304681','This is sample description','2022-09-27 16:17:55','2022-09-27 16:17:55');
INSERT INTO "resources" VALUES (6,1,11,3,1,'Information Technology Diploma Notes','information-technology-diploma-notes','300','1664295526CAMP KENNEDY ALUMNI ENGAGEMENT STRATEGY 2022 V1.docx','docx','8677999','This is sample description','2022-09-27 16:18:46','2022-09-27 16:18:46');
INSERT INTO "resources" VALUES (7,1,12,7,4,'Sample Resource','sample-resource','500','1664297186BA-LOOKBOOK-offline-version.pdf','pdf','20697584','This is a simple description','2022-09-27 16:46:27','2022-09-27 16:46:27');
INSERT INTO "resources" VALUES (9,1,11,7,1,'Computer Science lecture notes','computer-science-lecture-notes','0','1664351352Camp Kennedy Report 2021.pdf','pdf','5304681','These are lecture notes for computer science','2022-09-28 07:49:12','2022-09-28 07:49:12');
INSERT INTO "resources" VALUES (10,1,9,1,6,'Sample testing resource','sample-testing-resource','0','1664353318CAMP KENNEDY ALUMNI ENGAGEMENT STRATEGY 2022 V1.docx','docx','8677999','<p>Hello world and the rest of the people were not invited to the congregation.</p><p><b>This led to the grouping of</b></p>','2022-09-28 08:21:59','2022-09-28 08:21:59');
INSERT INTO "views" VALUES (1,5,'8','2022-09-28 11:26:59','2022-09-28 13:19:21');
INSERT INTO "views" VALUES (2,7,'12','2022-09-28 11:28:05','2022-09-28 18:47:43');
INSERT INTO "views" VALUES (3,4,'5','2022-09-28 11:30:30','2022-09-28 11:38:07');
INSERT INTO "views" VALUES (4,4,'1','2022-09-28 11:30:51','2022-09-28 11:30:51');
INSERT INTO "views" VALUES (5,4,'1','2022-09-28 11:30:56','2022-09-28 11:30:56');
INSERT INTO "views" VALUES (6,4,'1','2022-09-28 11:30:57','2022-09-28 11:30:57');
INSERT INTO "views" VALUES (7,4,'1','2022-09-28 11:30:58','2022-09-28 11:30:58');
INSERT INTO "views" VALUES (8,4,'1','2022-09-28 11:30:59','2022-09-28 11:30:59');
INSERT INTO "views" VALUES (9,6,'2','2022-09-28 11:38:19','2022-09-28 11:38:43');
INSERT INTO "views" VALUES (10,9,'4','2022-09-28 11:38:56','2022-09-28 18:45:19');
INSERT INTO "views" VALUES (11,10,'5','2022-09-28 12:25:56','2022-09-28 18:48:46');
INSERT INTO "views" VALUES (12,3,'3','2022-09-28 13:00:47','2022-09-28 18:45:02');
INSERT INTO "downloads" VALUES (1,4,'2','2022-09-28 11:31:46','2022-09-28 11:31:56');
INSERT INTO "downloads" VALUES (2,9,'11','2022-09-28 11:39:20','2022-09-28 18:45:38');
INSERT INTO "downloads" VALUES (3,10,'2','2022-09-28 12:26:00','2022-09-28 18:48:59');
CREATE UNIQUE INDEX IF NOT EXISTS "users_email_unique" ON "users" (
	"email"
);
CREATE UNIQUE INDEX IF NOT EXISTS "users_phone_unique" ON "users" (
	"phone"
);
CREATE INDEX IF NOT EXISTS "password_resets_email_index" ON "password_resets" (
	"email"
);
CREATE UNIQUE INDEX IF NOT EXISTS "failed_jobs_uuid_unique" ON "failed_jobs" (
	"uuid"
);
CREATE INDEX IF NOT EXISTS "personal_access_tokens_tokenable_type_tokenable_id_index" ON "personal_access_tokens" (
	"tokenable_type",
	"tokenable_id"
);
CREATE UNIQUE INDEX IF NOT EXISTS "personal_access_tokens_token_unique" ON "personal_access_tokens" (
	"token"
);
COMMIT;
