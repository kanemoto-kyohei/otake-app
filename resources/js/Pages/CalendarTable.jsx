import { useTable } from "react-table";
import moment from "moment";
import CalendarCell from "@/Pages/CalendarCell";
import "./responsivestyle.css";

const CalendarTable = (props) => {
    const { carender_elements } = props;

    const weekdays = carender_elements.japaneseWeekdays;
    const datesOfWeek = carender_elements.datesOfWeek;
    const times = carender_elements.times;

    const isTablet = window.matchMedia(
        "(min-width: 1024px) and (max-width: 2800px)"
    ).matches;
    const isMobile = window.matchMedia("(max-width: 768px)").matches;
    console.log(isMobile);

    const columns = [
        { Header: "日時", accessor: "time" },
        ...datesOfWeek.map((date) => {
            const MomentDate = moment(date.date);
            const header = `${MomentDate.format("M/D")}(${
                weekdays[MomentDate.format("d")]
            })`;
            const currents = MomentDate.format("YYYY-MM-DD");
            return {
                Header: header,
                accessor: currents,
            };
        }),
    ];

    const data = [
        ...times.map((eachtime) => {
            const time = eachtime;
            return {
                time: time,
                ...datesOfWeek.reduce((obj, dateOfWeek, i) => {
                    const date = dateOfWeek.date;
                    const dateStr = moment(date).format("YYYY-MM-DD");
                    obj[dateStr] = (
                        <CalendarCell
                            columnNum={i + 1}
                            date={dateStr}
                            time={time}
                        />
                    );
                    return obj;
                }, {}),
            };
        }),
    ];
    function Table({ columns, data }) {
        // Use the state and functions returned from useTable to build your UI
        const {
            getTableProps,
            getTableBodyProps,
            headerGroups,
            rows,
            prepareRow,
        } = useTable({
            columns,
            data,
        });

        return (
            <table {...getTableProps()}>
                <thead>
                    {headerGroups.map((headerGroup) => (
                        <tr {...headerGroup.getHeaderGroupProps()}>
                            {headerGroup.headers.map((column) => (
                                <th {...column.getHeaderProps()}>
                                    {column.render("Header")}
                                </th>
                            ))}
                        </tr>
                    ))}
                </thead>
                <tbody {...getTableBodyProps()}>
                    {rows.map((row, i) => {
                        prepareRow(row);
                        return (
                            <tr {...row.getRowProps()}>
                                {row.cells.map((cell) => {
                                    return (
                                        <td {...cell.getCellProps()}>
                                            {cell.render("Cell")}
                                        </td>
                                    );
                                })}
                            </tr>
                        );
                    })}
                </tbody>
            </table>
        );
    }
    return (
        <div className="flex justify-center items-center">
            <div
                className={`${isTablet ? "tablet-col" : ""}${
                    isMobile ? "mobile-col" : ""
                }`}
            >
                <Table columns={columns} data={data} />
            </div>
        </div>
    );
};
export default CalendarTable;
