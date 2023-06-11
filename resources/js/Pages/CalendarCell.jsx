import { usePage, Link } from "@inertiajs/react";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import React from "react";

const CalendarCell = (props) => {
    const { date, time, columnNum } = props;
    const { appointments, carender_elements, permalink } = usePage().props;

    const Myweekdays = carender_elements.weekdays;
    const holidays = carender_elements.holiday.map((holiday) =>
        moment(holiday, "M/D").format("M/D")
    );
    const currentDate = new Date();
    const currentDisplayDate = moment(currentDate).format("YYYY-MM-DD");

    const cell = () => {
        let result = false;
        for (let i = 0; i < Myweekdays.length; i++) {
            if (Myweekdays[i] === columnNum) {
                result = true;
                break;
            }
        }
        return result;
    };

    const holiday_find = () => {
        const dateformatted = moment(date).format("M/D");
        let result = false;
        for (let i = 0; i < holidays.length; i++) {
            if (dateformatted == holidays[i]) {
                result = true;
                break;
            }
        }
        return result;
    };

    const appointment_find = () => {
        let result = false;
        for (let i = 0; i < appointments.length; i++) {
            if (
                appointments[i].date === date &&
                appointments[i].time === time
            ) {
                result = true;
                break;
            }
        }
        return result;
    };

    const contents = () => {
        if (cell()) {
            return "×";
        } else if (holiday_find()) {
            return "×";
        } else if (appointment_find()) {
            return "×";
        } else if (moment(date) <= moment(currentDisplayDate)) {
            return "×";
        } else {
            return (
                <Link
                    style={{ color: "green" }}
                    href={route("appoint.inertiaConfirm", { permalink })}
                    method="post"
                    data={{
                        selected_date_time: `${date}|${time}`,
                    }}
                    as="button"
                    type="button"
                    preserveState={false}
                    onIonClick={(e) => {
                        e.preventDefault();
                        Inertia.post(
                            route("appoint.inertiaConfirm", { permalink }),
                            {
                                selected_date_time: `${date}|${time}`,
                            }
                        );
                    }}
                >
                    ◎
                </Link>
            );
        }
    };

    return <div>{contents()}</div>;
};
export default CalendarCell;
