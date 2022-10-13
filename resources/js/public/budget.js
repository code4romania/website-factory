import * as echarts from 'echarts/core';
import { TreemapChart } from 'echarts/charts';
import { CanvasRenderer } from 'echarts/renderers';

import { TitleComponent, TooltipComponent } from 'echarts/components';

echarts.use([TitleComponent, TooltipComponent, TreemapChart, CanvasRenderer]);

const valueFormatter = (value) => {
    return value.toLocaleString(document.documentElement.lang);
};

export default function (el, { expression }, { evaluate }) {
    const chart = echarts.init(el);

    const args = evaluate(expression);

    chart.setOption({
        series: [
            {
                name: args.name || null,
                type: 'treemap',
                left: 'left',
                top: 'top',
                right: 0,
                bottom: 50,
                leafDepth: 2,
                levels: [
                    {
                        itemStyle: {
                            borderColor: 'rgb(244,244,245)',
                            borderWidth: 16,
                            gapWidth: 10,
                        },
                    },
                    {
                        colorSaturation: [0.3, 0.6],
                        itemStyle: {
                            borderColorSaturation: 0.7,
                            gapWidth: 2,
                            borderWidth: 2,
                        },
                    },
                    {
                        colorSaturation: [0.3, 0.5],
                        itemStyle: {
                            borderColorSaturation: 0.6,
                            gapWidth: 1,
                        },
                    },
                    {
                        colorSaturation: [0.3, 0.5],
                    },
                ],
                animation: false,
                visibleMin: 500,
                roam: 'move',
                label: {
                    show: true,
                    position: 'insideTopLeft',
                    formatter: (params) =>
                        [
                            `{name|${params.name}}`,
                            '{hr|}',
                            `{value|${valueFormatter(params.value)}}`,
                        ].join('\n'),
                    fontFamily:
                        'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                    rich: {
                        name: {
                            fontSize: 12,
                            color: '#fff',
                        },
                        value: {
                            fontSize: 18,
                            fontWeight: 'bold',
                            color: '#fff',
                        },
                        hr: {
                            width: '100%',
                            borderColor: 'rgba(255,255,255,0.2)',
                            borderWidth: 0.5,
                            height: 0,
                            lineHeight: 10,
                        },
                    },
                },
                breadcrumb: {
                    show: true,
                    emptyItemWidth: 22,
                    bottom: 16,
                },
                data: args.data,
            },
        ],
        tooltip: {
            valueFormatter,
        },
    });

    window.addEventListener('resize', chart.resize);

    return chart;
}
