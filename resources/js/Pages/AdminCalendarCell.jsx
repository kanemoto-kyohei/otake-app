import { usePage } from "@inertiajs/react";
import React, { useState } from "react";
import moment from "moment";
import Modal from "@/Components/Modal";
import dayjs from "dayjs";
import "dayjs/locale/ja";

const AdminCalendarCell = (props) => {
    const { date, time, columnNum } = props;
    const [showModal, setShowModal] = useState(false);
    const { appointments, carender_elements } = usePage().props;
    const Myweekdays = carender_elements.weekdays;
    const holidays = carender_elements.holiday.map((holiday) =>
        moment(holiday, "M/D").format("M/D")
    );
    dayjs.locale("ja");

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
        let index = null;
        for (let i = 0; i < appointments.length; i++) {
            if (
                appointments[i].date === date &&
                appointments[i].time === time
            ) {
                index = i;
                result = true;
                break;
            }
        }
        if (result) {
            return appointments[index];
        } else {
            return false;
        }
    };

    const hundleModalOpen = () => {
        setShowModal(true);
    };

    const hundleModalClose = () => {
        setShowModal(false);
    };

    const renderModalContent = () => {
        const appointment = appointment_find();
        if (appointment) {
            return (
                <div>
                    <h1
                        className="text-center mt-4"
                        style={{
                            fontWeight: "bold",
                            textDecoration: "underline",
                        }}
                    >
                        予約者
                    </h1>
                    <h1 className="text-center mt-2">{appointment.name}</h1>
                    <p className="text-center mb-4">{appointment.email}</p>
                    <p className="text-center mb-4">{appointment.extra}</p>

                    <h1
                        className="text-center"
                        style={{
                            fontWeight: "bold",
                            textDecoration: "underline",
                        }}
                    >
                        予約時間
                    </h1>
                    <p className="text-center mt-2">
                        {dayjs(appointment.date).format("M/D (ddd)")}
                    </p>
                    <p className="text-center mb-4">{appointment.time}</p>
                </div>
            );
        } else {
            return null;
        }
    };

    const contents = () => {
        if (cell()) {
            return "×";
        } else if (holiday_find()) {
            return "×";
        } else {
            let appointment = appointment_find();
            if (appointment) {
                return (
                    <div>
                        <button
                            style={{
                                fontWeight: "bold",
                                textDecoration: "underline",
                            }}
                            onClick={hundleModalOpen}
                        >
                            {appointment.name}
                        </button>
                        {showModal && (
                            <Modal show={true} onClose={hundleModalClose}>
                                {renderModalContent()}
                            </Modal>
                        )}
                    </div>
                );
            } else {
                return "-";
            }
        }
    };

    return <div>{contents()}</div>;
};
export default AdminCalendarCell;
