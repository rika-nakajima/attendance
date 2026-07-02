```mermaid
erDiagram

    USERS ||--o{ ATTENDANCES : "has many"
    USERS ||--o{ ATTENDANCE_CORRECTION_REQUESTS : "requests"

    ATTENDANCES ||--o{ BREAKS : "has many"
    ATTENDANCES ||--o{ ATTENDANCE_CORRECTION_REQUESTS : "has many"

    USERS {
        bigint id PK
        string name
        string email
        timestamp email_verified_at
        string password
        tinyint role "0:一般 1:管理者"
        timestamp created_at
        timestamp updated_at
    }

    ATTENDANCES {
        bigint id PK
        bigint user_id FK
        date date
        datetime clock_in
        datetime clock_out
        tinyint status "0:勤務外 1:出勤中 2:休憩中 3:退勤済"
        text note
        timestamp created_at
        timestamp updated_at
    }

    BREAKS {
        bigint id PK
        bigint attendance_id FK
        datetime break_start
        datetime break_end
        timestamp created_at
        timestamp updated_at
    }

    ATTENDANCE_CORRECTION_REQUESTS {
        bigint id PK
        bigint attendance_id FK
        bigint user_id FK
        datetime before_clock_in
        datetime before_clock_out
        json before_breaks
        datetime after_clock_in
        datetime after_clock_out
        json after_breaks
        text note
        tinyint status "0:承認待ち 1:承認済み"
        timestamp created_at
        timestamp updated_at
    }
